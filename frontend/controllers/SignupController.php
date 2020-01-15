<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use frontend\models\User;
use frontend\models\RegistrationForm;

class SignupController extends Controller
{
    public function actionIndex()
    {
        $data = 'Нет данных';
        $userForm = new RegistrationForm();
        if (Yii::$app->request->getIsPost()) {
            $data = 'Есть данные';
            /*
            $userForm->load(Yii::$app->request->post());
            if ($model->validate()) {
                $user = new User();
                $user->attributes = $userForm->attributes;
                $user->save();
                return $this->redirect(Url::to(['tasks/index']));
            }
            */
        }

        return $this->render('index', ['userForm' => $userForm, 'data' => $data]);
    }
}