<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;
use TaskForce\Utils\Processings\NextNumber;

class ProfileModel extends AbstractModel
{
    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $birthday;

    /**
     * @var string
     */
    private $about;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $skype;

    /**
     * @var int
     */
    private $user_id;
    
    public function __construct(array $csvRow)
    {
        $this->address = $csvRow[0];
        $this->birthday = $csvRow[1];
        $this->about = $csvRow[2];
        $this->phone = $csvRow[3];
        $this->skype = $csvRow[4];
        $this->user_id = NextNumber::getNumber();
    }

    public function getTableName() : string 
    {
        return 'profile';
    }
    
    public static function getColumnsCSV() : array
    {
        return ['address', 'bd', 'about', 'phone', 'skype'];
    }

    public function getColumnsSQL() : array
    {
        return ['address', 'birthday', 'about', 'phone', 'skype', 'user_id'];
    }

    public function getValues() : array
    {
        return [
            'address' => $this->address,
            'birthday' => $this->birthday,
            'about' => $this->about,
            'phone' => $this->phone,
            'skype' => $this->skype,
            'user_id' => $this->user_id
        ];
    }
}