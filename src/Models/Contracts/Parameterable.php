<?php

namespace EolabsIo\AmazonMwsClient\Models\Contracts;

interface Parameterable
{
    public function toParameters(): array;
}