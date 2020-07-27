<?php

namespace EolabsIo\AmazonMwsClient\Tests\Unit;

use EolabsIo\AmazonMwsClient\Models\Endpoint;
use EolabsIo\AmazonMwsClient\Tests\BaseModelTest;


class EndpointTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return Endpoint::class;
    }
}