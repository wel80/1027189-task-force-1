<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $city
 * @property float $latitude
 * @property float $longitude
 *
 * @property User[] $users
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city', 'latitude', 'longitude'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['city'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['city_id' => 'id']);
    }
}
