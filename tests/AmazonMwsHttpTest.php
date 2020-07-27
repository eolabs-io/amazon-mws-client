<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsClient\Facades\AmazonMwsHttp;
use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMwsClient\Models\Participation;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMwsClient\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class AmazonMwsHttpTest extends TestCase
{

	use RefreshDatabase;

	/** @var EolabsIo\AmazonMwsClient\Models\Store */
	private $store;

    /** @var Collection */
    private $marketplaces;


    public function setUp(): void
    {
        parent::setUp();

		$this->store = factory(Store::class)->create(['secret_key' => 'EXAMPLE+HOf9NtN2r1XqALt7fc9EL290cpEXBg',
                                                      'amazon_service_url' => 'https://mws.amazonservices.com',
                                                    ]);

        $participations = factory(Participation::class, 3)
                            ->create(['seller_id' => $this->store->seller_id]);

        $this->marketplaces = $participations->load('marketplace')->pluck('marketplace');
    }

    /** @test */
    public function it_can_make_a_endpoint_request()
    {
    	Http::fake();

        $parameters = ['SignatureMethod' => 'HmacSHA256'];
        $endpoint = 'someEndpoint/version';

    	$response = AmazonMwsHttp::withStore($this->store)->fetch($endpoint, $parameters);

        Http::assertSent(function ($request){
        	return $request->url() == 'https://mws.amazonservices.com/someEndpoint/version' &&
                   $request['SignatureMethod'] == 'HmacSHA256';
        });
    }

    /** @test */
    public function it_can_sign_a_request()
    {
    	Http::fake();

        $parameters = ['SignatureMethod' => 'HmacSHA256'];
        $endpoint = 'someEndpoint/version';
        $signature = 'G02CZZWUrjUtIJNQQUL+zQVa39p0Z6hlQV0qwBuIsew=';

    	$response = AmazonMwsHttp::withStore($this->store)->fetch($endpoint, $parameters);

        Http::assertSent(function ($request) use ($signature) {
        	return $request->url() == 'https://mws.amazonservices.com/someEndpoint/version' &&
                   $request['SignatureMethod'] == 'HmacSHA256' &&
                   $request['Signature'] == $signature;
        });
    }

    /** @test */
    public function it_can_get_marketplace_ids()
    {
        Http::fake();

        $registeredMarketplaceIds = AmazonMwsHttp::withStore($this->store)->getRegisteredMarketplaceIds();

        $this->assertArraysEqual($registeredMarketplaceIds,   
                            $this->marketplaces->pluck('marketplace_id')->values()->toArray()
                        );
        
    }
 
    /** @test */
    public function it_fails_to_get_marketplace_ids()
    {
        Http::fake();
        
        DB::table('marketplaces')->delete();

        $registeredMarketplaceIds = AmazonMwsHttp::withStore($this->store)->getRegisteredMarketplaceIds();

        $this->assertEquals($registeredMarketplaceIds, []);
        
    }

    // Helpers //
    private function assertArraysEqual($array1, $array2){

        $sortedArray1 = Arr::sortRecursive($array1);
        $sortedArray2 = Arr::sortRecursive($array2);

        // return
        $this->assertEquals($sortedArray1, $sortedArray2);
    }

}