<?php

namespace EolabsIo\AmazonMwsClient\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'aws_access_key_id',
                    'mws_auth_token',
                    'secret_key',
                    'seller_id',
                    'amazon_service_url',
				]; 

}