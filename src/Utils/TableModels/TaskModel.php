<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class TaskModel extends AbstractModel
{
    /**
     * @var string
     */
    private $created_at;

    /**
     * @var int
     */
    private $category_id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $expire;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var int
     */
    private $budget;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var int
     */
    private $author_id;
    
    public function __construct(array $csvRow)
    {
        $this->created_at = $csvRow[0];
        $this->category_id = $csvRow[1];
        $this->status = 'new';
        $this->description = $csvRow[2];
        $this->expire = $csvRow[3];
        $this->name = $csvRow[4];
        $this->address = $csvRow[5];
        $this->budget = $csvRow[6];
        $this->latitude = $csvRow[7];
        $this->longitude = $csvRow[8];
        $this->author_id = random_int(1, 20);
    }
    
    public function getTableName() : string
    {
        return 'task';
    }
    
    public static function getColumnsCSV() : array
    {
        return ['dt_add', 'category_id', 'description', 'expire', 'name', 'address', 'budget', 'lat', 'long'];
    }

    public function getColumnsSQL() : array
    {
        return ['created_at', 'category_id', 'status', 'description', 'expire', 'name', 'address', 'budget', 'latitude', 'longitude', 'author_id'];
    }

    public function getValues() : array
    {
        return [
            'created_at' => $this->created_at,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'description' => $this->description,
            'expire' => $this->expire,
            'name' => $this->name,
            'address' => $this->address,
            'budget' => $this->budget,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'author_id' => $this->author_id
        ];
    }
}