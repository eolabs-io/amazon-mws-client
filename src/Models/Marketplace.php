<?php

namespace EolabsIo\AmazonMwsClient\Models;

use EolabsIo\AmazonMwsClient\Models\Contracts\Parameterable;
use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model implements Parameterable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'name',
                    'country_code',
                    'endpoint',
                    'marketplace_id',
				]; 
                
    protected $hidden = ['pivot'];

    public function toParameters(): array
    {
        return [
            'endpoint' => $this->endpoint,
            'marketplace_id' => $this->marketplace_id,
        ];
    }

}