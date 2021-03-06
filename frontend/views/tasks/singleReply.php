<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\helpers\Path;
use TaskForce\Tasks\Status;

/**
 * @var yii\web\View $this
 * @var \frontend\models\Reply $reply
 */

$formatter = \Yii::$app->formatter;
?>
                        <div class="content-view__feedback-card">
                            <div class="feedback-card__top">
                                <a href="#"><img src="<?=Path::toAvatar($reply->author)?>" width="55" height="55"></a>
                                <div class="feedback-card__top--name">
                                    <p><a href="#" class="link-regular"><?=Html::encode($reply->author->name)?></a></p>
                                    <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                                   <b>4.25</b>
                                </div>
                                <span class="new-task__time"><?=$formatter->asRelativeTime($reply->created_at)?></span>
                            </div>
                            <div class="feedback-card__content">
                                <p>
                                <?=Html::encode($reply->description)?>
                                </p>
                                <span><?=Html::encode($reply->rate)?> ₽</span>
                            </div>
                            <?php if (\Yii::$app->user->getId() === $task->author_id
                                && $task->status === Status::STATUS_NEW
                                && $reply->status === Status::STATUS_NEW) { ?>
                            <div class="feedback-card__actions">
                                <a href="<?=Url::to(['reply/accept', 'replyId' => $reply->id])?>"
                                    class="button__small-color request-button button"
                                    type="button">Подтвердить</a>
                                <a href="<?=Url::to(['reply/deny', 'replyId' => $reply->id])?>"
                                    class="button__small-color refusal-button button"
                                    type="button">Отказать</a>
                            </div>
                            <?php } ?>
                        </div>