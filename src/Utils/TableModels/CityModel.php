<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class CityModel extends AbstractModel
{
    private static $city = 'city';
    private static $lat = 'lat';
    private static $long = 'long';
    private static $latitude = 'latitude';
    private static $longitude = 'longitude';
    private $csvRow;
    
    public function __construct(array $csvRow)
    {
        $this->csvRow = $csvRow;
    }

    public static function getTableName() : string 
    {
        return self::$city;
    }
    
    public static function getColumnsCSV() : array
    {
        return [self::$city, self::$lat, self::$long];
    }

    public static function getColumnsSQL() : string
    {
        return self::$city . ', ' . self::$latitude . ', ' . self::$longitude;
    }

    public function getValues() : string
    {
        return implode(', ', array_map(function($item) {return '"' . htmlspecialchars($item) . '"';}, $this->csvRow));
    }
}