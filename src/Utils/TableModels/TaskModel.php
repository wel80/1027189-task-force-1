<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class TaskModel extends AbstractModel
{
    public static function getTableName() : string 
    {
        return 'task';
    }
    
    public static function getColumnsCSV() : array
    {
        return ['dt_add', 'category_id', 'description', 'expire', 'name', 'address', 'budget', 'lat', 'long'];
    }

    public static function getColumnsSQL() : array
    {
        return ['created_at', 'category_id', 'description', 'expire', 'name', 'address', 'budget', 'latitude', 'longitude', 'author_id'];
    }

    public static function getValues(array $csvRow) : array
    {
        $csvRow[] = random_int(1, 20);
        return $csvRow;
    }
}