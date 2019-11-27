<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class UserModel extends AbstractModel
{
    private static $user = 'user';
    private static $email = 'email';
    private static $name = 'name';
    private static $password = 'password';
    private static $dt_add = 'dt_add';
    private static $date_registration = 'date_registration';
    private static $city_id = 'city_id';
    private $csvRow;
    
    public function __construct(array $csvRow)
    {
        $this->csvRow = $csvRow;
        $this->csvRow[] = random_int(1, 1108);
    }
    
    public static function getTableName() : string 
    {
        return self::$user;
    }
    
    public static function getColumnsCSV() : array
    {
        return [self::$email, self::$name, self::$password, self::$dt_add];
    }

    public static function getColumnsSQL() : string
    {
        return sprintf('%s, %s, %s, %s, %s', self::$email, self::$name, self::$password, self::$date_registration, self::$city_id);
    }

    public function getValues() : string
    {
        return implode(', ', array_map(function($item) {return '"' . htmlspecialchars($item) . '"';}, $this->csvRow));
    }
}