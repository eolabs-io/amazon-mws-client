<?php

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use Faker\Generator as Faker;

$factory->define(Marketplace::class, function (Faker $faker) {

	$marketplaceIds = ['A2Q3Y263D00KWC','A2EUQ1WTGCTBG2', 'A1AM78C64UM0Y8', 'ATVPDKIKX0DER','A2VIGQ35RCS4UG', 'A1PA6795UKMFR9', 'ARBP9OOSHTCHU','A1RKKUPIHCS9HS', 'A13V1IB3VIYZZH', 'A1F83G8C2ARO7P', 'A21TJRUUN4KGV','APJ6JRA9NG5V4','A1805IZSGTT6HS', 'A17E79C6D8DWNP', 'A33AVAJ2PDY3EV', 'A19VAU5U5O7RUS', 'A39IBJ37TRP1C6', 'A1VC38T7YXB528'];

    return [
            'marketplace_id' => $faker->unique()->randomElement($marketplaceIds), 
            'name' => $faker->country,
            'default_country_code' => $faker->countryCode,
            'default_currency_code' => $faker->currencyCode,
            'default_language_code' => $faker->languageCode,
            'domain_name' => $faker->url(),
    ];
});


