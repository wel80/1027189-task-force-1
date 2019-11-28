<?php

namespace TaskForce\Utils\TableModels;
use TaskForce\Utils\TableModels\AbstractModel;

class CityModel extends AbstractModel
{
    /**
     * @var string
     */
    private $city;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    public function __construct(array $csvRow)
    {
        $this->city = $csvRow[0];
        $this->latitude = $csvRow[1];
        $this->longitude = $csvRow[2];
    }

    public function getTableName() : string
    {
        return 'city';
    }

    public static function getColumnsCSV() : array
    {
        return ['city', 'lat', 'long'];
    }

    public function getColumnsSQL() : array
    {
        return ['city', 'latitude', 'longitude'];
    }

    public function getValues(): array
    {
        return [
            'city' => $this->city,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}