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

    public function __construct(FileRead $fileRead, FileWrite $fileWrite, string $tableName)
    {
        $this->fileRead = $fileRead;
        $this->fileWrite = $fileWrite;
        $this->tableName = $tableName;
    }


    public function transmission(array $columns) : void
    {        
        if (!$this->validateColumns($columns)) {
            throw new FileFormatException("Для таблицы " . $this->tableName . " заданы неверные заголовки столбцов");
        }
        
        $headerData = $this->fileRead->fgetcsv();
        foreach($columns as $column) {
            if(!in_array($column, $headerData)) {
                $headerData[] = $column;
            }
        }
        if(array_values($columns) !== $headerData) {
            throw new FileFormatException("Файл для чтения не содержит необходимых столбцов");
        }


        $template = 'INSERT INTO %s (%s) VALUES (%s);%s';
        while (!$this->fileRead->eof()) {
            $nextData = $this->fileRead->fgetcsv();
            $nextData = array_map([$this, 'escapeCharacter'], $nextData);
            foreach($columns as $column) {
                if (is_int($column)) {
                    $nextData[] = random_int(1, $column);
                }
            }
            $this->fileWrite->fwrite(sprintf($template, $this->tableName, implode(', ', array_keys($columns)), implode(', ', $nextData), PHP_EOL));
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


    private function escapeCharacter(string $item) : string
    {
        return '"' . htmlspecialchars($item) . '"';
    }
}
