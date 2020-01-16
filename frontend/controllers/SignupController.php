<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\User;
use frontend\models\RegistrationForm;
use yii\db\Exception;
use yii\web\ServerErrorHttpException;

class SignupController extends Controller
{
    public function actionIndex()
    {
        $userForm = new RegistrationForm();
        if (Yii::$app->request->getIsPost()) {
            if (!$userForm->load(Yii::$app->request->post())) {
                throw new ServerErrorHttpException("Форма записи аккаунта не существует");
            }
            if ($userForm->validate()) {
                $userForm->user->attributes = $userForm->attributes;
                if ($userForm->user->save()) {
                    return $this->goHome();                    
                }
                throw new Exception("Не удалось записать аккаунт в базу данных");
            }
        }
        return $this->render('index', ['userForm' => $userForm]);
    }
}