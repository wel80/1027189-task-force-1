<?php

namespace TaskForce\Utils;

use TaskForce\Utils\Processings\FileRead;
use TaskForce\Utils\Processings\FileWrite;
use TaskForce\Tasks\Exceptions\FileFormatException;

class TransmissionData
{
    private $fileRead;
    private $fileWrite;
    private $tableModel;

    public function __construct(FileRead $fileRead, FileWrite $fileWrite, string $tableModel)
    {
        $this->fileRead = $fileRead;
        $this->fileWrite = $fileWrite;
        $this->tableModel = $tableModel;
    }


    public function transmission() : void
    {
        if (!$this->validateColumns($this->tableModel::getColumnsSQL())) {
            throw new FileFormatException("Для таблицы " . $this->tableModel::getTableName() . " заданы неверные заголовки столбцов");
        }
        
        $headerData = $this->fileRead->fgetcsv();
        if($this->tableModel::getColumnsCSV() !== $headerData) {
            throw new FileFormatException("Файл для чтения не содержит необходимых столбцов");
        }


        $template = 'INSERT INTO %s (%s) VALUES (%s);%s';
        while (!$this->fileRead->eof()) {
            $nextData = $this->fileRead->fgetcsv();
            $nextData = $this->tableModel::getValues($nextData);
            $nextData = array_map([$this, 'escapeCharacter'], $nextData);
            $this->fileWrite->fwrite(sprintf($template, $this->tableModel::getTableName(), implode(', ', $this->tableModel::getColumnsSQL()), implode(', ', $nextData), PHP_EOL));
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


    private function escapeCharacter(string $item) : string
    {
        return '"' . htmlspecialchars($item) . '"';
    }
}
