<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class ProfileModel extends AbstractModel
{
    private static $profile = 'profile';
    private static $address = 'address';
    private static $bd = 'bd';
    private static $about = 'about';
    private static $phone = 'phone';
    private static $skype = 'skype';
    private static $birthday = 'birthday';
    private static $user_id = 'user_id';
    private $csvRow;
    
    public function __construct(array $csvRow)
    {
        $this->csvRow = $csvRow;
        $this->csvRow[] = random_int(1, 20);
    }

    public static function getTableName() : string 
    {
        return self::$profile;
    }
    
    public static function getColumnsCSV() : array
    {
        return [self::$address, self::$bd, self::$about, self::$phone, self::$skype];
    }

    public static function getColumnsSQL() : string
    {
        return sprintf('%s, %s, %s, %s, %s, %s', self::$address, self::$birthday, self::$about, self::$phone, self::$skype, self::$user_id);
    }

    public function getValues() : string
    {
        return implode(', ', array_map(function($item) {return '"' . htmlspecialchars($item) . '"';}, $this->csvRow));
    }
}