<?php

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMwsClient\Models\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
    return [
			'aws_access_key_id' => $faker->text(14), 
			'mws_auth_token' => $faker->text(14),
			'secret_key' => $faker->sha1(),
			'seller_id' => $faker->text(14),
			'amazon_service_url' => $faker->url(), // 'https://mws.amazonservices.com/',
    ];
});
