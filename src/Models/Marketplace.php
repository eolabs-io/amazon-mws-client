<?php

namespace EolabsIo\AmazonMwsClient\Models;

use EolabsIo\AmazonMwsClient\Models\Contracts\Parameterable;
use EolabsIo\AmazonMwsClient\Models\Endpoint;
use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model implements Parameterable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'marketplace_id', 
                    'name',
                    'default_country_code',
                    'default_currency_code',
                    'default_language_code',
                    'domain_name',
				]; 

    protected $hidden = ['laravel_through_key'];

    public function mwsEndpoint()
    {
        return $this->belongsTo(Endpoint::class, 'marketplace_id', 'marketplace_id');
    }

    public function toParameters(): array
    {
        return [
            'endpoint' => $this->mwsEndpoint->endpoint,
            'marketplace_id' => $this->marketplace_id,
        ];
    }

}