<?php

namespace EolabsIo\AmazonMwsClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EolabsIo\AmazonMwsHttp\Skeleton\SkeletonClass
 */
class AmazonMwsHttp extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'amazon-mws-http';
    }
}
