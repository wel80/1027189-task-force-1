<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use frontend\models\Category;
use frontend\models\Task;
use TaskForce\Tasks\Status;

class TaskForm extends Model
{    
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $category_id;

    /**
     * @var int
     */
    public $budget;

    /**
     * @var string
     */
    public $expire;
    
    public function attributeLabels() : array
    {
        return [
            'name' => 'Мне нужно',
            'description' => 'Подробности задания',
            'category_id' => 'Категория',
            'budget' => 'Бюджет',
            'expire' => 'Срок исполнения'
        ];
    }

    public function rules() : array
    {
        return [
            [['name', 'description'], 'trim'],
            [['name', 'description'], 'required', 'message' => 'Это поле надо заполнить!'],
            ['name', 'string', 'min' => 10, 'max' => 100, 
                'tooShort' => 'Количество знаков в этом поле должно быть не менее 10-ти.',
                'tooLong' => 'Количество знаков в этом поле должно быть не более 100.'],
            ['description', 'string', 'min' => 30, 'tooShort' => 'Количество знаков в этом поле должно быть не менее 30-ти.'],
            ['category_id', 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id'],
            ['budget', 'integer', 'min' => 1,
                'message' => 'Укажите в этом поле целое число.',
                'tooSmall' => 'Укажите в этом поле целое число больше нуля.'],
            ['expire', 'string'],
        ];
    }

    public function getCategoryList() : array
    {
        $categoriesAll = Category::find()->all();
        return ArrayHelper::map($categoriesAll, 'id', 'name');
    }

    public function getNewTaskId() : int
    {
        $newTask = new Task();
        $newTask->attributes = $this->attributes;
        $newTask->status = Status::STATUS_NEW;
        $newTask->author_id = Yii::$app->user->getId();
        $newTask->latitude = 50;
        $newTask->longitude = 50;
        if ($newTask->save()) {
            return $newTask->primaryKey;
        }
        throw new Exception("Не удалось записать новое задание в базу данных");
    }
}