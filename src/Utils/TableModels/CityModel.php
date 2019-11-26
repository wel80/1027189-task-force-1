<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class CityModel extends AbstractModel
{
    public static function getTableName() : string 
    {
        return 'city';
    }
    
    public static function getColumnsCSV() : array
    {
        return ['city', 'lat', 'long'];
    }

    public static function getColumnsSQL() : array
    {
        return ['city', 'latitude', 'longitude'];
    }

    public static function getValues(array $csvRow) : array
    {
        return $csvRow;
    }
}