<?php

namespace EolabsIo\AmazonMwsClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see EolabsIo\AmazonMwsClient\Support\UrlSigner;
 */
class UrlSigner extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'url-signer';
    }
}