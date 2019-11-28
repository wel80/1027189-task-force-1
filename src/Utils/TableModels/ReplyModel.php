<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class ReplyModel extends AbstractModel
{
    /**
     * @var string
     */
    private $created_at;

    /**
     * @var int
     */
    private $rate;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $author_id;

    /**
     * @var int
     */
    private $task_id;
    
    public function __construct(array $csvRow)
    {
        $this->created_at = $csvRow[0];
        $this->rate = $csvRow[1];
        $this->description = $csvRow[2];
        $this->author_id = random_int(1, 20);
        $this->task_id = random_int(1, 10);
    }

    public function getTableName() : string 
    {
        return 'reply';
    }
    
    public static function getColumnsCSV() : array
    {
        return ['dt_add', 'rate', 'description'];
    }

    public function getColumnsSQL() : array
    {
        return ['created_at', 'rate', 'description', 'author_id', 'task_id'];
    }

    public function getValues() : array
    {
        return [
            'created_at' => $this->created_at,
            'rate' => $this->rate,
            'description' => $this->description,
            'author_id' => $this->author_id,
            'task_id' => $this->task_id
        ];
    }
}