<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\City;
use frontend\models\User;

class RegistrationForm extends \yii\base\Model
{    
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $city_id;

    /**
     * @var string
     */
    public $password;
    
    public function attributeLabels() : array
    {
        return [
            'email' => 'Электронная почта',
            'name' => 'Ваше имя',
            'city_id' => 'Город проживания',
            'password' => 'Пароль',
        ];
    }

    public function rules() : array
    {
        return [
            [['email', 'name'], 'trim'],
            [['email', 'name', 'password'], 'required', 'message' => 'Это поле надо заполнить!'],
            ['email', 'email', 'message' => 'Укажите корректный электронный адрес!'],
            ['email', 'string', 'max' => 100, 'tooLong' => 'Количество знаков в этом поле должно быть не более 100.'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'Такой электронный адрес уже существует.'],
            ['name', 'string', 'min' => 3, 'max' => 100, 
                'tooShort' => 'Количество знаков в этом поле должно быть не менее 3-х.',
                'tooLong' => 'Количество знаков в этом поле должно быть не более 100.'],
            ['city_id', 'exist', 'targetClass' => City::className(), 'targetAttribute' => 'id'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'Количество знаков в этом поле должно быть не менее 6-ти.'],
        ];
    }

    public function getCityList() : array
    {
        $citiesAll = City::find()->all();
        return ArrayHelper::map($citiesAll, 'id', 'city');
    }

    public function createUser() : bool
    {
        $newUser = new User();
        $newUser->attributes = $this->attributes;
        $newUser->password = Yii::$app->security->generatePasswordHash($this->password);
        if ($newUser->save()) {
            return true;                    
        }
        return false;
    }
}