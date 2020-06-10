<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMwsClient\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;


class StoreTest extends TestCase
{
	use RefreshDatabase;


   /** @test */
    public function it_can_find_models()
    {
        $storesInDb = factory(Store::class, 10)->create();
        $stores = Store::All();

        $this->assertArraysEqual($stores->toArray(), $storesInDb->toArray());
    }

   /** @test */
    public function it_can_create_a_model()
    {
        $store = factory(Store::class)->create();
        
        $this->assertInstanceOf(Store::class, $store);
        $this->assertDatabaseHas('stores', $store->toArray());
    }

    /** @test */
    public function it_can_update_a_model()
    {
        $store = factory(Store::class)->create();
        $data = factory(Store::class)->make()->toArray();

        $update = $store->update($data);

        $this->assertTrue($update);
        $this->assertDatabaseHas('stores', $store->toArray());
    }


    /** @test */
    public function it_can_delete_a_model()
    {
        $store = factory(Store::class)->create();

        $store->delete();

        $this->assertDatabaseMissing('stores', $store->toArray());
    }

    /** @test */
    public function it_can_create_parameter_array()
    {
        $store = factory(Store::class)->create();

        $expectedParameters = [
            'AWSAccessKeyId' => $store->aws_access_key_id,
            'MWSAuthToken' => $store->mws_auth_token,
            'SellerId' => $store->seller_id
        ];

        $this->assertArraysEqual($expectedParameters, $store->toParameters());   
    }

    /** @test */
    public function it_has_marketplace_relationship()
    {
        $this->seed();
        $firstThreeMarketPalces = Marketplace::all()->take(3);
        
        $store = factory(Store::class)->create();
        $store->marketplaces()->toggle($firstThreeMarketPalces);

        $this->assertArraysEqual($firstThreeMarketPalces->toArray(), $store->marketplaces->toArray()); 
    }

    // Helpers //
    private function assertArraysEqual($array1, $array2){

        $sortedArray1 = Arr::sortRecursive($array1);
        $sortedArray2 = Arr::sortRecursive($array2);

        // return
        $this->assertEquals($sortedArray1, $sortedArray2);
    }
}
