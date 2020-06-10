<?php

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use Faker\Generator as Faker;

$factory->define(Marketplace::class, function (Faker $faker) {
	$countryCodes = ['BR', 'CA', 'MX', 'US', 'AE', 'DE', 'EG', 'ES', 'FR', 'GB', 'IN', 'IT', 'NL', 'SA', 'TR', 'SG', 'AU', 'JP'];

    return [
			'name' => $faker->unique()->text(14), 
			'country_code' => $faker->unique()->randomElement($countryCodes),
			'endpoint' => $faker->url(), // 'https://mws.amazonservices.com/',
			'marketplace_id' => $faker->text(14),
    ];
});