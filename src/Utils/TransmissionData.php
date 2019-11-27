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
        $headerData = $this->fileRead->fgetcsv();
        if($this->tableModel::getColumnsCSV() !== $headerData) {
            throw new FileFormatException("Файл для чтения не содержит необходимых столбцов");
        }


        $template = 'INSERT INTO %s (%s) VALUES (%s);%s';
        while (!$this->fileRead->eof()) {
            $nextData = $this->fileRead->fgetcsv();
            $nextData = new $this->tableModel($nextData);
            $this->fileWrite->fwrite(sprintf($template, $nextData::getTableName(), $nextData::getColumnsSQL(), $nextData->getValues(), PHP_EOL));
        }
    }
}
