<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\User;
use frontend\models\RegistrationForm;
use yii\filters\AccessControl;
use yii\db\Exception;

class SignupController extends Controller
{
    public $layout = 'registration';
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?']
                    ]
                ]
            ]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function actionIndex()
    {
        $userForm = new RegistrationForm();
        if (Yii::$app->request->getIsPost() && $userForm->load(Yii::$app->request->post())) {
            if ($userForm->validate()) {
                if ($userForm->createUser()) {
                    return $this->goHome();
                }
                throw new Exception("Не удалось записать аккаунт в базу данных");
            }
        }
        return $this->render('index', ['userForm' => $userForm]);
    }
}