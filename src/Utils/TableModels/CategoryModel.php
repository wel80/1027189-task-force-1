<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class CategoryModel extends AbstractModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $icon;
    
    public function __construct(array $csvRow)
    {
        $this->name = $csvRow[0];
        $this->icon = $csvRow[1];
    }
    
    public function getTableName() : string 
    {
        return 'category';
    }
    
    public static function getColumnsCSV() : array
    {
        return ['name', 'icon'];
    }

    public function getColumnsSQL() : array
    {
        return ['name', 'icon'];
    }

    public function getValues() : array
    {
        return [
            'name' => $this->name,
            'icon' => $this->icon
        ];
    }
}