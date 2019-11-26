<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class ReplyModel extends AbstractModel
{
    public static function getTableName() : string 
    {
        return 'reply';
    }
    
    public static function getColumnsCSV() : array
    {
        return ['dt_add', 'rate', 'description'];
    }

    public static function getColumnsSQL() : array
    {
        return ['created_at', 'rate', 'description', 'author_id', 'task_id'];
    }

    public static function getValues(array $csvRow) : array
    {
        $csvRow[] = random_int(1, 20);
        $csvRow[] = random_int(1, 10);
        return $csvRow;
    }
}