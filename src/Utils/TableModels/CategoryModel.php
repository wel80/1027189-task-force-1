<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class CategoryModel extends AbstractModel
{
    public static function getTableName() : string 
    {
        return 'category';
    }
    
    public static function getColumnsCSV() : array
    {
        return ['name', 'icon'];
    }

    public static function getColumnsSQL() : array
    {
        return ['name', 'icon'];
    }

    public static function getValues(array $csvRow) : array
    {
        return $csvRow;
    }
}