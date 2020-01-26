<?php

namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use frontend\models\Category;
use frontend\models\File;

class FileForm extends Model
{    
    /**
     * @var UploadedFile
     */
    public $file;
    
    public function attributeLabels() : array
    {
        return [
            'file' => 'Файлы',
        ];
    }

    public function rules() : array
    {
        return [
            [['file'], 'file'],
        ];
    }

    public function createFile(int $id_task) : bool
    {
        if (empty($this->file)) {
            return true;
        }

        $newFile = new File();
        $path = 'uploads/' . $this->file->baseName . '.' . $this->file->extension;
        $newFile->path = $path;
        $newFile->task_id = $id_task;
        if ($this->file->saveAs($path) && $newFile->save()) {
            return true;
        }
        throw new Exception("Не удалось записать новое задание в базу данных");
    }
}