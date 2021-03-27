<?php

namespace EolabsIo\AmazonMwsClient\Database\Seeders;

use EolabsIo\AmazonMwsClient\Models\Endpoint;
use Illuminate\Database\Seeder;

class EndpointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->endpoints() as $endpoint) {
            Endpoint::create($endpoint);
        }
    }

    public function endpoints(): array
    {
        return [
            ['name' => 'Brazil', 'country_code' => 'BR', 'endpoint' => 'https://mws.amazonservices.com', 'marketplace_id' => 'A2Q3Y263D00KWC'],
            ['name' => 'Canada', 'country_code' => 'CA', 'endpoint' => 'https://mws.amazonservices.ca', 'marketplace_id' => 'A2EUQ1WTGCTBG2'],
            ['name' => 'Mexico', 'country_code' => 'MX', 'endpoint' => 'https://mws.amazonservices.com.mx', 'marketplace_id' => 'A1AM78C64UM0Y8'],
            ['name' => 'US', 'country_code' => 'US', 'endpoint' => 'https://mws.amazonservices.com', 'marketplace_id' => 'ATVPDKIKX0DER'],
            ['name' => 'United Arab Emirates (U.A.E.)', 'country_code' => 'AE', 'endpoint' => 'https://mws.amazonservices.ae', 'marketplace_id' => 'A2VIGQ35RCS4UG'],
            ['name' => 'Germany', 'country_code' => 'DE', 'endpoint' => 'https://mws-eu.amazonservices.com', 'marketplace_id' => 'A1PA6795UKMFR9'],
            ['name' => 'Egypt', 'country_code' => 'EG', 'endpoint' => 'https://mws-eu.amazonservices.com', 'marketplace_id' => 'ARBP9OOSHTCHU'],
            ['name' => 'Spain', 'country_code' => 'ES', 'endpoint' => 'https://mws-eu.amazonservices.com', 'marketplace_id' => 'A1RKKUPIHCS9HS'],
            ['name' => 'France', 'country_code' => 'FR', 'endpoint' => 'https://mws-eu.amazonservices.com', 'marketplace_id' => 'A13V1IB3VIYZZH'],
            ['name' => 'UK', 'country_code' => 'GB', 'endpoint' => 'https://mws-eu.amazonservices.com', 'marketplace_id' => 'A1F83G8C2ARO7P'],
            ['name' => 'India', 'country_code' => 'IN', 'endpoint' => 'https://mws.amazonservices.in', 'marketplace_id' => 'A21TJRUUN4KGV'],
            ['name' => 'Italy', 'country_code' => 'IT', 'endpoint' => 'https://mws-eu.amazonservices.com', 'marketplace_id' => 'APJ6JRA9NG5V4'],
            ['name' => 'Netherlands', 'country_code' => 'NL', 'endpoint' => 'https://mws-eu.amazonservices.com', 'marketplace_id' => 'A1805IZSGTT6HS'],
            ['name' => 'Saudi Arabia', 'country_code' => 'SA', 'endpoint' => 'https://mws-eu.amazonservices.com', 'marketplace_id' => 'A17E79C6D8DWNP'],
            ['name' => 'Turkey', 'country_code' => 'TR', 'endpoint' => 'https://mws-eu.amazonservices.com', 'marketplace_id' => 'A33AVAJ2PDY3EV'],
            ['name' => 'Singapore', 'country_code' => 'SG', 'endpoint' => 'https://mws-fe.amazonservices.com', 'marketplace_id' => 'A19VAU5U5O7RUS'],
            ['name' => 'Australia', 'country_code' => 'AU', 'endpoint' => 'https://mws.amazonservices.com.au', 'marketplace_id' => 'A39IBJ37TRP1C6'],
            ['name' => 'Japan', 'country_code' => 'JP', 'endpoint' => 'https://mws.amazonservices.jp', 'marketplace_id' => 'A1VC38T7YXB528'],
        ];
    }
}
