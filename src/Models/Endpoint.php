<?php

namespace EolabsIo\AmazonMwsClient\Models;

use EolabsIo\AmazonMwsClient\Models\AmazonMwsClientModel;
use EolabsIo\AmazonMwsClient\Database\Factories\EndpointFactory;

class Endpoint extends AmazonMwsClientModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'marketplace_id',
                    'name',
                    'country_code',
                    'endpoint',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return EndpointFactory::new();
    }
}
