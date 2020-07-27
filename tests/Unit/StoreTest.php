<?php

namespace EolabsIo\AmazonMwsClient\Tests\Unit;

use EolabsIo\AmazonMwsClient\Models\Participation;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMwsClient\Tests\BaseModelTest;


class StoreTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return Store::class;
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
        $store = factory(Store::class)->create();
        $participations = factory(Participation::class, 3)->create(['seller_id' => $store->seller_id]);
        $marketplaces = $participations->load('marketplace')->pluck('marketplace');

        $this->assertArraysEqual($marketplaces->toArray(), $store->marketplaces->toArray()); 
    }

}
