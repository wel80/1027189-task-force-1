<?php

namespace TaskForce\Utils\Processings;

use TaskForce\Tasks\Exceptions\SourceFileException;

class FileRead extends \SplFileObject
{
    public function __construct(string $read)
    {
        if (!is_readable($read)) {
            throw new SourceFileException('Файл для чтения "' . $read . '" не существует или недоступен для чтения.');
        }
        parent::__construct($read, 'r');
    }
}