<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\web\Controller;
use frontend\models\Message;

/**
* Default controller for the `api` module
*/
class MessagesController extends ActiveController
{
    public $modelClass = Message::class;
}