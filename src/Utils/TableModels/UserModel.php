<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class UserModel extends AbstractModel
{
    public static function getTableName() : string 
    {
        return 'user';
    }
    
    public static function getColumnsCSV() : array
    {
        return ['email', 'name', 'password', 'dt_add'];
    }

    public static function getColumnsSQL() : array
    {
        return ['email', 'name', 'password', 'date_registration', 'city_id'];
    }

    public static function getValues(array $csvRow) : array
    {
        $csvRow[] = random_int(1, 1108);
        return $csvRow;
    }
}