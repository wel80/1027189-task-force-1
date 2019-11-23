<?php

namespace TaskForce\Utils\Processings;

use TaskForce\Tasks\Exceptions\SourceFileException;

class FileRead extends \SplFileObject
{
    public function __construct(string $filePath)
    {
        if (!is_readable($filePath)) {
            throw new SourceFileException('Файл для чтения "' . $filePath . '" не существует или недоступен для чтения.');
        }
        parent::__construct($filePath, 'r');
    }
}