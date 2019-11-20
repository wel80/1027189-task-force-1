<?php

namespace TaskForce\Utils\Processings;

use TaskForce\Tasks\Exceptions\SourceFileException;

class FileWrite extends \SplFileObject
{
    public function __construct(string $write)
    {
        parent::__construct($write, 'w');
    }
}