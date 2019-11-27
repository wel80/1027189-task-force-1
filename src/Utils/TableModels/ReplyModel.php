<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class ReplyModel extends AbstractModel
{
    private static $reply = 'reply';
    private static $dt_add = 'dt_add';
    private static $rate = 'rate';
    private static $description = 'description';
    private static $created_at = 'created_at';
    private static $author_id = 'author_id';
    private static $task_id = 'task_id';
    private $csvRow;
    
    public function __construct(array $csvRow)
    {
        $this->csvRow = $csvRow;
        $this->csvRow[] = random_int(1, 20);
        $this->csvRow[] = random_int(1, 10);
    }

    public static function getTableName() : string 
    {
        return self::$reply;
    }
    
    public static function getColumnsCSV() : array
    {
        return [self::$dt_add, self::$rate, self::$description];
    }

    public static function getColumnsSQL() : string
    {
        return sprintf('%s, %s, %s, %s, %s', self::$created_at, self::$rate, self::$description, self::$author_id, self::$task_id);
    }

    public function getValues() : string
    {
        return implode(', ', array_map(function($item) {return '"' . htmlspecialchars($item) . '"';}, $this->csvRow));
    }
}