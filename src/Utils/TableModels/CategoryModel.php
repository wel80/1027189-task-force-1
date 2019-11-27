<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class CategoryModel extends AbstractModel
{
    private static $category = 'category';
    private static $name = 'name';
    private static $icon = 'icon';
    private $csvRow;
    
    public function __construct(array $csvRow)
    {
        $this->csvRow = $csvRow;
    }
    
    public static function getTableName() : string 
    {
        return self::$category;
    }
    
    public static function getColumnsCSV() : array
    {
        return [self::$name, self::$icon];
    }

    public static function getColumnsSQL() : string
    {
        return self::$name . ', ' . self::$icon;
    }

    public function getValues() : string
    {
        return implode(', ', array_map(function($item) {return '"' . htmlspecialchars($item) . '"';}, $this->csvRow));
    }
}