<?php

namespace TaskForce\Utils;

use TaskForce\Tasks\Exceptions\FileFormatException;
use TaskForce\Tasks\Exceptions\SourceFileException;

class TransmissionData
{
    private $fileRead;
    private $fileWrite;
    private $tableName;
    private $columns;

    public function __construct(string $fileRead, string $fileWrite, string $tableName, array $columns)
    {
        $this->fileRead = $fileRead;
        $this->fileWrite = $fileWrite;
        $this->tableName = $tableName;
        $this->columns = $columns;
    }


    public function transmission()
    {
        if (!file_exists($this->fileRead)) {
            throw new SourceFileException("Файл для чтения '" . $this->fileRead . "' не существует");
        }
        
        if (!$this->validateColumns($this->columns)) {
            throw new FileFormatException("Для таблицы '" . $this->tableName . "' заданы неверные заголовки столбцов");
        }
        
        $objectRead = new \SplFileObject($this->fileRead, 'r');
        $objectWrite = new \SplFileObject($this->fileWrite, 'w');
        
        $header_data = $objectRead->fgetcsv();

        if ($header_data !== $this->columns) {
            throw new FileFormatException("Файл для чтения '" . $this->fileRead . "' не содержит необходимых столбцов");
        }
        $objectWrite->fwrite("INSERT INTO " . $this->tableName . " (" . implode(', ', $header_data) . ")" . PHP_EOL . "VALUES ");
        
        while ($next_data = $objectRead->fgetcsv()) {
            if (!$objectRead->eof()) {
                $objectWrite->fwrite("(" . implode(', ', $next_data) . "),". PHP_EOL);
            } else {
                $objectWrite->fwrite("(" . implode(', ', $next_data) . ");");
            }
        }
    }


    private function validateColumns(array $columns) : bool
    {
        if (!count($columns)) {
            return false;
        }

        foreach ($columns as $column) {
            if (!is_string($column)) {
                return false;
            }
        }
        return true;
    }
}
