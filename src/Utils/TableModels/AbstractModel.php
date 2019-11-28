<?php

namespace TaskForce\Utils\TableModels;

abstract class AbstractModel
{
    abstract public function getTableName() : string;
    abstract public static function getColumnsCSV() : array;
    abstract public function getColumnsSQL() : array;
    abstract public function getValues(): array;
    
    public function getSQLRow() : string
    {
        $template = 'INSERT INTO %s (%s) VALUES (%s);' . PHP_EOL;

        return sprintf(
            $template,
            $this->getTableName(),
            implode(', ', $this->getColumnsSQL()),
            implode(', ', array_map(function (string $item) {
                    return '"' . htmlspecialchars($item) . '"';
                },
                $this->getValues()
            ))
        );
    }
}