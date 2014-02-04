<?php

namespace Play\UseCase;

interface RequestInterface
{
    public static function fromArray(array $params);
}
