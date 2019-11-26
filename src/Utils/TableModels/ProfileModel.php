<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class ProfileModel extends AbstractModel
{
    public static function getTableName() : string 
    {
        return 'profile';
    }
    
    public static function getColumnsCSV() : array
    {
        return ['address', 'bd', 'about', 'phone', 'skype'];
    }

    public static function getColumnsSQL() : array
    {
        return ['address', 'birthday', 'about', 'phone', 'skype', 'user_id'];
    }

    public static function getValues(array $csvRow) : array
    {
        $csvRow[] = random_int(1, 20);
        return $csvRow;
    }
}