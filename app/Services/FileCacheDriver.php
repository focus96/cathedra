<?php

namespace App\Services;

use Overdesign\PsrCache\FileCacheDriver as FileCacheDriverPSR6;
use Psr\Log\InvalidArgumentException;

class FileCacheDriver extends FileCacheDriverPSR6
{
    public function __construct()
    {
        $path = storage_path('/framework/cache');
        parent::__construct($path);
    }

    private function checkKey($key)
    {
        if (!is_string($key)) {
            throw new InvalidArgumentException('The given key must be a string.');
        } elseif (!preg_match('/^[a-zA-Z\d\.\_]+$/', $key)) {
            throw new InvalidArgumentException(sprintf('The given key %s contains invalid characters.', $key));
        }

        return $key;
    }
}