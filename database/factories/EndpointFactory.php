<?php

use EolabsIo\AmazonMwsClient\Models\Endpoint;
use Faker\Generator as Faker;

$factory->define(Endpoint::class, function (Faker $faker) {
	$countryCodes = ['BR', 'CA', 'MX', 'US', 'AE', 'DE', 'EG', 'ES', 'FR', 'GB', 'IN', 'IT', 'NL', 'SA', 'TR', 'SG', 'AU', 'JP'];

    return [
			'name' => $faker->text(14), 
			'country_code' => $faker->unique()->randomElement($countryCodes),
			'endpoint' => $faker->url(), // 'https://mws.amazonservices.com/',
			'marketplace_id' => $faker->text(14),
    ];
});