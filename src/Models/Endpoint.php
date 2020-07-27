<?php

namespace EolabsIo\AmazonMwsClient\Models;

use Illuminate\Database\Eloquent\Model;

class Endpoint extends Model
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

}