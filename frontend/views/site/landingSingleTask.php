<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
use frontend\models\Task;

/**
 * @var yii\web\View $this
 * @var \frontend\models\Task $task
 */

$formatter = \Yii::$app->formatter;
?>

<div class="landing-task">
    <div class="landing-task-top task-<?=Html::encode($task->category->icon)?>"></div>
    <div class="landing-task-description">
        <h3><a href="<?=Url::to(['tasks/view', 'id' => $task->id])?>" class="link-regular"><?=Html::encode($task->name)?></a></h3>
        <p><?=Html::encode(BaseStringHelper::truncate($task->description, Task::SHORT_DESCRIPTION_LENGTH))?></p>
    </div>
    <div class="landing-task-info">
        <div class="task-info-left">
            <p><a href="#" class="link-regular"><?=Html::encode($task->category->name)?></a></p>
            <p><?=$formatter->asRelativeTime($task->created_at)?></p>
        </div>
        <span><?=Html::encode($task->budget)?><b> ₽</b></span>
    </div>
</div>