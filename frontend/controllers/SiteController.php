<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use frontend\models\LoginForm;
use frontend\models\Task;
use TaskForce\Tasks\Status;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'landing';

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(Url::to(['tasks/index']));
        }

        $loginForm = new LoginForm();
        if (Yii::$app->request->getIsPost() 
        && $loginForm->load(Yii::$app->request->post()) 
        && $loginForm->validate()) {
            $user = $loginForm->getUser();
            if (Yii::$app->user->login($user)) {
                return $this->redirect(Url::to(['tasks/index']));
            }
        }
        
        $tasks = Task::find()
        ->joinWith('category')
        ->where(['task.status' => Status::STATUS_NEW])
        ->orderBy(['task.created_at' => SORT_DESC])
        ->limit(4)
        ->all();

        return $this->render('index', ['tasks' => $tasks, 'loginForm' => $loginForm]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        return $this->goHome();
    }
}
