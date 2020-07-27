<?php

namespace EolabsIo\AmazonMwsClient\Models;

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use Illuminate\Database\Eloquent\Model;


class Participation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
					        'marketplace_id', 
                            'seller_id',
                            'has_seller_suspended_listings',
    					];

    public function marketplace()
    {
        return $this->belongsTo(Marketplace::class, 'marketplace_id', 'marketplace_id');
    }

}