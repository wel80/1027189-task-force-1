<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class UserModel extends AbstractModel
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $date_registration;

    /**
     * @var int
     */
    private $city_id;
    
    public function __construct(array $csvRow)
    {
        $this->email = $csvRow[0];
        $this->name = $csvRow[1];
        $this->password = $csvRow[2];
        $this->date_registration = $csvRow[3];
        $this->city_id = random_int(1, 1108);
    }
    
    public function getTableName() : string 
    {
        return 'user';
    }
    
    public static function getColumnsCSV() : array
    {
        return ['email', 'name', 'password', 'dt_add'];
    }

    public function getColumnsSQL() : array
    {
        return ['email', 'name', 'password', 'date_registration', 'city_id'];
    }

    public function getValues() : array
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'date_registration' => $this->date_registration,
            'city_id' => $this->city_id
        ];
    }
}