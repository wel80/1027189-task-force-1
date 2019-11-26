<?php

namespace TaskForce\Utils\TableModels;

abstract class AbstractModel
{
    abstract public static function getTableName() : string;
    abstract public static function getColumnsCSV() : array;
    abstract public static function getColumnsSQL() : array;
    abstract public static function getValues(array $csvRow) : array;
}