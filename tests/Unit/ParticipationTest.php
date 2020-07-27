<?php

namespace EolabsIo\AmazonMwsClient\Tests\Unit;

use EolabsIo\AmazonMwsClient\Models\Participation;
use EolabsIo\AmazonMwsClient\Tests\BaseModelTest;


class ParticipationTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return Participation::class;
    }

}