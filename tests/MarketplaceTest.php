<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMwsClient\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;


class MarketplaceTest extends TestCase
{
	use RefreshDatabase;

   /** @test */
    public function it_can_find_models()
    {
        $marketplacesInDb = factory(Marketplace::class, 5)->create();
        $marketplaces = Marketplace::All();

        $this->assertArraysEqual($marketplaces->toArray(), $marketplacesInDb->toArray());
    }

   /** @test */
    public function it_can_create_a_model()
    {
        $marketplace = factory(Marketplace::class)->create();
        
        $this->assertInstanceOf(Marketplace::class, $marketplace);
        $this->assertDatabaseHas('Marketplaces', $marketplace->toArray());
    }

    /** @test */
    public function it_can_update_a_model()
    {
        $marketplace = factory(Marketplace::class)->create();
        $data = factory(Marketplace::class)->make()->toArray();

        $update = $marketplace->update($data);

        $this->assertTrue($update);
        $this->assertDatabaseHas('Marketplaces', $marketplace->toArray());
    }


    /** @test */
    public function it_can_delete_a_model()
    {
        $marketplace = factory(Marketplace::class)->create();

        $marketplace->delete();

        $this->assertDatabaseMissing('Marketplaces', $marketplace->toArray());
    }

    /** @test */
    public function it_can_create_parameter_array()
    {
        $marketplace = factory(Marketplace::class)->create();

        $expectedParameters = [
            'endpoint' => $marketplace->endpoint,
            'marketplace_id' => $marketplace->marketplace_id,
        ];

        $this->assertArraysEqual($expectedParameters, $marketplace->toParameters());   
    }

    // Helpers //
    private function assertArraysEqual($array1, $array2){

        $sortedArray1 = Arr::sortRecursive($array1);
        $sortedArray2 = Arr::sortRecursive($array2);

        // return
        $this->assertEquals($sortedArray1, $sortedArray2);
    }
}
