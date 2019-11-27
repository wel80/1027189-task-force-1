<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class TaskModel extends AbstractModel
{
    private static $task = 'task';
    private static $dt_add = 'dt_add';
    private static $category_id = 'category_id';
    private static $description = 'description';
    private static $expire = 'expire';
    private static $name = 'name';
    private static $address = 'address';
    private static $budget = 'budget';
    private static $lat = 'lat';
    private static $long = 'long';
    private static $created_at = 'created_at';
    private static $latitude = 'latitude';
    private static $longitude = 'longitude';
    private static $author_id = 'author_id';
    private $csvRow;
    
    public function __construct(array $csvRow)
    {
        $this->csvRow = $csvRow;
        $this->csvRow[] = random_int(1, 20);
    }
    
    public static function getTableName() : string
    {
        return self::$task;
    }
    
    public static function getColumnsCSV() : array
    {
        return [self::$dt_add, self::$category_id, self::$description, self::$expire, self::$name, self::$address, self::$budget, self::$lat, self::$long];
    }

    public static function getColumnsSQL() : string
    {
        return sprintf('%s, %s, %s, %s, %s, %s, %s, %s, %s, %s', self::$created_at, self::$category_id, self::$description, self::$expire, self::$name, self::$address, self::$budget, self::$latitude, self::$longitude, self::$author_id);
    }

    public function getValues() : string
    {
        return implode(', ', array_map(function($item) {return '"' . htmlspecialchars($item) . '"';}, $this->csvRow));
    }
}