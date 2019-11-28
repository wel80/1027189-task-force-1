<?php

namespace TaskForce\Utils\Processings;

use TaskForce\Tasks\Exceptions\SourceFileException;

class FileWrite extends \SplFileObject
{
    public function __construct(string $filePath)
    {
        parent::__construct($filePath, 'w');
    }
}