<?php

namespace EolabsIo\AmazonMwsClient\Models;

use EolabsIo\AmazonMwsClient\Models\Contracts\Parameterable;
use Illuminate\Database\Eloquent\Model;

class Store extends Model implements Parameterable
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


    public function toParameters(): array
    {
        return [
            'AWSAccessKeyId' => $this->aws_access_key_id,
            'MWSAuthToken' => $this->mws_auth_token,
            'SellerId' => $this->seller_id,
        ];
    }

}