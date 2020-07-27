<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMwsClient\Models\Participation;
use EolabsIo\AmazonMwsClient\Models\Store;
use Faker\Generator as Faker;

$factory->define(Participation::class, function (Faker $faker) {
    return [
            'marketplace_id' => function() {
            	return factory(Marketplace::class)->create()->marketplace_id;
            }, 
            'seller_id' => function() {
            	return factory(Store::class)->create()->seller_id;
            }, 
            'has_seller_suspended_listings' => $faker->randomElement(['No', 'Restricted']), 
    ];
});