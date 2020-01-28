<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use frontend\models\Category;
use frontend\models\Task;
use TaskForce\Tasks\Status;
use yii\web\UploadedFile;
use frontend\models\File;

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

    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @var int
     */
    public $taskId;
    
    public function attributeLabels() : array
    {
        return [
            'name' => 'Мне нужно',
            'description' => 'Подробности задания',
            'category_id' => 'Категория',
            'budget' => 'Бюджет',
            'expire' => 'Срок исполнения',
            'file' => 'Файлы',
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
            [['file'], 'file'],
        ];
    }

    public function getCategoryList() : array
    {
        $categoriesAll = Category::find()->all();
        return ArrayHelper::map($categoriesAll, 'id', 'name');
    }

    public function createTask() : bool
    {
        $newTask = new Task();
        $newTask->category_id = $this->category_id;
        $newTask->status = Status::STATUS_NEW;
        $newTask->description = $this->description;
        $newTask->expire = $this->expire;
        $newTask->name = $this->name;
        $newTask->address = 'Адрес выполнения работ и оказания услуг';
        $newTask->budget = $this->budget;
        $newTask->latitude = 0;
        $newTask->longitude = 0;
        $newTask->author_id = Yii::$app->user->getId(); 

        if (!$newTask->save()) {
            return false;
        }

        $this->taskId = $newTask->primaryKey;

        if (!is_object($this->file)) {
            return true;
        }

        $newFile = new File();
        $path = 'uploads/' . $this->file->baseName . '.' . $this->file->extension;
        $newFile->path = $path;
        $newFile->task_id = $this->taskId;

        if ($this->file->saveAs($path) && $newFile->save()) {
            return true;
        }
        return false;
    }
}