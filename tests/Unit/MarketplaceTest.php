<?php

namespace EolabsIo\AmazonMwsClient\Tests\Unit;

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMwsClient\Tests\BaseModelTest;
use EndpointSeeder;

class MarketplaceTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return Marketplace::class;
    }

    /** @test */
    public function it_can_create_parameter_array()
    {
        $this->seed(EndpointSeeder::class);
        $marketplace = factory(Marketplace::class)->create();

        $expectedParameters = [
            'endpoint' => $marketplace->mwsEndpoint->endpoint,
            'marketplace_id' => $marketplace->marketplace_id,
        ];

        $this->assertArraysEqual($expectedParameters, $marketplace->toParameters());   
    }
}
