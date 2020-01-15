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
        $userForm = new RegistrationForm();
        if (Yii::$app->request->getIsPost()) {
            $userForm->load(Yii::$app->request->post());
            if ($userForm->validate()) {
                $user = new User();
                $user->attributes = $userForm->attributes;
                $user->save();
                return $this->redirect(Url::to(['tasks/index']));
            }
        }

        return $this->render('index', ['userForm' => $userForm]);
    }
}