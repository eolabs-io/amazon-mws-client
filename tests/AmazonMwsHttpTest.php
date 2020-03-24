<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsClient\Facades\AmazonMwsHttp;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMwsClient\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;


class AmazonMwsHttpTest extends TestCase
{

	use RefreshDatabase;

	/** @var EolabsIo\AmazonMwsClient\Models\Store */
	private $store;


    public function setUp(): void
    {
        parent::setUp();

		$this->store = factory(Store::class)->create(['amazon_service_url' => 'https://mws.amazonservices.com', 
													  'secret_key' => 'EXAMPLE+HOf9NtN2r1XqALt7fc9EL290cpEXBg']);
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
        
}