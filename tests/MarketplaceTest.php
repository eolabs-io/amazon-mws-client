<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMwsClient\Tests\BaseModelTest;
use EolabsIo\AmazonMwsClient\Database\Seeders\EndpointSeeder;

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
        $marketplace = Marketplace::factory()->create();

        $expectedParameters = [
            'endpoint' => $marketplace->mwsEndpoint->endpoint,
            'marketplace_id' => $marketplace->marketplace_id,
        ];

        $this->assertArraysEqual($expectedParameters, $marketplace->toParameters());
    }
}
