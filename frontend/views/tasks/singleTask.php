<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var \frontend\views\tasks\index $task
 */
?>
                    <div class="new-task__card">
                        <div class="new-task__title">
                            <a href="#" class="link-regular"><h2><?=Html::encode($task->name); ?></h2></a>
                            <a  class="new-task__type link-regular" href="#"><p><?=$task->category->name; ?></p></a>
                        </div>
                        <div class="new-task__icon new-task__icon--<?=$task->category->icon; ?>"></div>
                        <p class="new-task_description"><?=Html::encode($task->description); ?></p>
                        <b class="new-task__price new-task__price--<?=$task->category->icon; ?>"><?=Html::encode($task->budget); ?><b> ₽</b></b>
                        <p class="new-task__place">Санкт-Петербург, Центральный район</p>
                        <span class="new-task__time"><?=$task->created_at; ?></span>
                    </div>