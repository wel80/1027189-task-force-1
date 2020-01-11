<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\helpers\Path;
use frontend\helpers\Time;
use frontend\helpers\NameNumber;

/**
 * @var yii\web\View $this
 * @var \frontend\models\Task $task
 */

$this->title = 'Задание '.Html::encode($task->id);
?>
            <section class="content-view">
                <div class="content-view__card">
                    <div class="content-view__card-wrapper">
                        <div class="content-view__header">
                            <div class="content-view__headline">
                                <h1><?=Html::encode($task->name)?></h1>
                                <span>Размещено в категории
                                <a href="#" class="link-regular"><?=Html::encode($task->category->name)?></a>
                                <?=\Yii::$app->formatter->asRelativeTime($task->created_at)?></span>
                            </div>
                            <b class="new-task__price new-task__price--<?=$task->category->icon?> content-view-price"><?=Html::encode($task->budget)?><b> ₽</b></b>
                            <div class="new-task__icon new-task__icon--<?=$task->category->icon?> content-view-icon"></div>
                        </div>
                        <div class="content-view__description">
                            <h3 class="content-view__h3">Общее описание</h3>
                            <p><?=Html::encode($task->description)?></p>
                        </div>
                        <div class="content-view__attach">
                            <h3 class="content-view__h3">Вложения</h3>
                            <?php foreach($task->files as $file) {
                                print Html::a($file->path);
                            }?>
                        </div>
                        <div class="content-view__location">
                            <h3 class="content-view__h3">Расположение</h3>
                            <div class="content-view__location-wrapper">
                                <div class="content-view__map">
                                    <a href="#"><img src="<?=Url::to("/img/map.jpg")?>" width="361" height="292"
                                    alt="<?=Html::encode($task->address)?>"></a>
                                </div>
                                <div class="content-view__address">
                                    <span class="address__town">Москва</span><br>
                                    <span><?=Html::encode($task->address)?></span>
                                    <p>Вход под арку, код домофона 1122</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-view__action-buttons">
                            <button class=" button button__big-color response-button open-modal"
                                    type="button" data-for="response-form">Откликнуться</button>
                            <button class="button button__big-color refusal-button open-modal"
                                    type="button" data-for="refuse-form">Отказаться</button>
                      <button class="button button__big-color request-button open-modal"
                              type="button" data-for="complete-form">Завершить</button>
                    </div>
                </div>
                <?php if (count($task->replies)) { ?>
                <div class="content-view__feedback">
                    <h2>Отклики <span>(<?=count($task->replies)?>)</span></h2>
                    <div class="content-view__feedback-wrapper">
                    <?php foreach($task->getReplies()->orderBy(['created_at' => SORT_DESC])->all() as $reply) {
                        print $this->render('singleReply', ['reply' => $reply]);
                    } ?>
                    </div>
                </div>
                <?php } ?>
            </section>
            <section class="connect-desk">
                <div class="connect-desk__profile-mini">
                    <div class="profile-mini__wrapper">
                        <h3>Заказчик</h3>
                        <div class="profile-mini__top">
                            <img src="<?=Path::toAvatar($task->author->profile->avatar)?>" width="62" height="62" alt="Аватар заказчика">
                            <div class="profile-mini__name five-stars__rate">
                                <p><?=Html::encode($task->author->name)?></p>
                            </div>
                        </div>
                        <p class="info-customer"><span><?=NameNumber::forCountTasks($task->author->getCreatedTasks()->count())?></span>
                        <span class="last-"><?=Time::durationToNow($task->author->date_registration)?> на сайте</span></p>
                        <a href="#" class="link-regular">Смотреть профиль</a>
                    </div>
                </div>
                <div class="connect-desk__chat">
                    <h3>Переписка</h3>
                    <div class="chat__overflow">
                        <div class="chat__message chat__message--out">
                            <p class="chat__message-time">10.05.2019, 14:56</p>
                            <p class="chat__message-text">Привет. Во сколько сможешь
                                приступить к работе?</p>
                        </div>
                        <div class="chat__message chat__message--in">
                            <p class="chat__message-time">10.05.2019, 14:57</p>
                            <p class="chat__message-text">На задание
                            выделены всего сутки, так что через час</p>
                        </div>
                        <div class="chat__message chat__message--out">
                            <p class="chat__message-time">10.05.2019, 14:57</p>
                            <p class="chat__message-text">Хорошо. Думаю, мы справимся</p>
                        </div>
                    </div>
                    <p class="chat__your-message">Ваше сообщение</p>
                    <form class="chat__form">
                        <textarea class="input textarea textarea-chat" rows="2" name="message-text" placeholder="Текст сообщения"></textarea>
                        <button class="button chat__button" type="submit">Отправить</button>
                    </form>
                </div>
            </section>