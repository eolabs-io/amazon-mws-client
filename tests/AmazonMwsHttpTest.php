<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsClient\Facades\AmazonMwsHttp;
use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMwsClient\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class AmazonMwsHttpTest extends TestCase
{

	use RefreshDatabase;

	/** @var EolabsIo\AmazonMwsClient\Models\Store */
	private $store;


    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $firstFourMarketPalces = Marketplace::all()->take(4);

		$this->store = factory(Store::class)->create(['secret_key' => 'EXAMPLE+HOf9NtN2r1XqALt7fc9EL290cpEXBg',
                                                      'amazon_service_url' => 'https://mws.amazonservices.com',
                                                    ]);

        $this->store->marketplaces()->toggle($firstFourMarketPalces);

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

        $this->assertEquals($registeredMarketplaceIds,   
                            ["A2Q3Y263D00KWC","A2EUQ1WTGCTBG2","A1AM78C64UM0Y8","ATVPDKIKX0DER"]
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

}