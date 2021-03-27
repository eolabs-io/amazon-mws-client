<?php

namespace EolabsIo\AmazonMwsClient\Models;

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMwsClient\Models\AmazonMwsClientModel;
use EolabsIo\AmazonMwsClient\Database\Factories\ParticipationFactory;

class Participation extends AmazonMwsClientModel
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ParticipationFactory::new();
    }
}
