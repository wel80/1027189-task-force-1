<?php

namespace TaskForce\Utils;

use TaskForce\Utils\Processings\FileRead;
use TaskForce\Utils\Processings\FileWrite;
use TaskForce\Tasks\Exceptions\FileFormatException;
use TaskForce\Tasks\Exceptions\SourceFileException;

class TransmissionData
{
    private $fileRead;
    private $fileWrite;
    private $tableName;
    private $columns;

    public function __construct(FileRead $fileRead, FileWrite $fileWrite, string $tableName, array $columns)
    {
        $this->fileRead = $fileRead;
        $this->fileWrite = $fileWrite;
        $this->tableName = $tableName;
        $this->columns = $columns;
    }


    public function transmission()
    {        
        if (!$this->validateColumns($this->columns)) {
            throw new FileFormatException("Для таблицы " . $this->tableName . " заданы неверные заголовки столбцов");
        }
        
        $headerData = $this->fileRead->fgetcsv();
        $headerData = array_map(function($item) { return htmlspecialchars($item); }, $headerData);
        foreach ($headerData as $data) {
            if (!in_array($data, $this->columns)) {
                throw new FileFormatException("Файл для чтения не содержит необходимых столбцов");
            }
        }

        $template = 'INSERT INTO %s (%s) VALUES (%s);%s';
        while (!$this->fileRead->eof()) {
            $nextData = $this->fileRead->fgetcsv();
            $nextData = array_map(function($item) { return htmlspecialchars($item); }, $nextData);
            foreach($this->columns as $columnKey => $columnValue) {
                if (!in_array($columnKey, $headerData)) {
                    $nextData[] = random_int(1, $columnValue);
                }
            }
            $this->fileWrite->fwrite(sprintf($template, $this->tableName, implode(', ', array_keys($this->columns)), implode(', ', $nextData), PHP_EOL));
        }
    }


    private function validateColumns(array $columns) : bool
    {
        if (!count($columns)) {
            return false;
        }

        foreach ($columns as $columnKey => $columnValue) {
            if (!is_string($columnKey)) {
                return false;
            }
        }
        return true;
    }
}
