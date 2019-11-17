<?php

namespace TaskForce\Utils;

use TaskForce\Utils\Processings\SplFileReadObject;
use TaskForce\Utils\Processings\SplFileWriteObject;
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

        if (!file_exists($this->fileWrite)) {
            throw new SourceFileException("Файл для записи '" . $this->fileWrite . "' не существует");
        }
        
        if (!$this->validateColumns($this->columns)) {
            throw new FileFormatException("Для таблицы '" . $this->tableName . "' заданы неверные заголовки столбцов");
        }
        
        $objectRead = new SplFileReadObject($this->fileRead, 'r');
        $objectWrite = new SplFileWriteObject($this->fileWrite, 'w');

        $objectRead->rewind();
        $objectWrite->rewind();
        
        $header_data = $objectRead->fgetcsv();

        // Поиск ошибки
        print 'Требуемые названия столбцов:  ';
        var_dump($this->columns);
        print '<br>';
        print 'Названия столбцов в CSV-файле:  ';
        var_dump($header_data);
        print '<br>';

        if ($header_data !== $this->columns) {
            throw new FileFormatException("Файл для чтения '" . $this->fileRead . "' не содержит необходимых столбцов");
        }
        $objectWrite->fwrite("USE task_forse_wel80;\r\nINSERT INTO " . $this->tableName . " (" . implode(', ', $header_data) . ")\r\nVALUES ");
        
        if (!$objectRead->eof()) {
            $next_data = $objectRead->fgetcsv();
            $objectWrite->fwrite("(" . implode(', ', $next_data) . ")");
        }

        while (!$objectRead->eof()) {
            $next_data = $objectRead->fgetcsv();
            $objectWrite->fwrite(", \r\n(" . implode(', ', $next_data) . ")");
        }
        $objectWrite->fwrite(";");
    }


    private function validateColumns(array $columns) : bool
    {
        $result = true;
        if (count($columns)) {
            foreach ($columns as $column) {
                if (!is_string($column)) {
                    $result = false;
                }
            }
        }
        else {
            $result = false;
        }
        return $result;
    }
}
