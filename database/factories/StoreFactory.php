<?php

namespace EolabsIo\AmazonMwsClient\Database\Factories;

use EolabsIo\AmazonMwsClient\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'aws_access_key_id' => $this->faker->numerify('###-#######-#######'),
            'mws_auth_token' => $this->faker->text(14),
            'secret_key' => $this->faker->sha1(),
            'seller_id' => $this->faker->text(14),
            'amazon_service_url' => $this->faker->url(), // 'https://mws.amazonservices.com/',
        ];
    }
}
