<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\helpers\Path;
use frontend\helpers\Time;
use frontend\helpers\NameNumber;
use TaskForce\Tasks\Status;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use frontend\models\Reply;

/**
 * @var yii\web\View $this
 * @var \frontend\models\Task $task
 */

$this->title = 'Задание '.Html::encode($task->id);
$formatter = \Yii::$app->formatter;
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
                        print Html::a($file->path, Url::to([$file->path]));
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
                <?php if (in_array(Status::ACTION_OFFER, $actions) 
                && !in_array(Yii::$app->user->getId(), ArrayHelper::getColumn($task->replies, 'author_id'))) { ?>
                    <button class=" button button__big-color response-button open-modal"
                        type="button" data-for="response-form">Откликнуться</button>
                <?php }?>
                <?php if (in_array(Status::ACTION_REFUSE, $actions)) {?>
                    <button class="button button__big-color refusal-button open-modal"
                        type="button" data-for="refuse-form">Отказаться</button>
                <?php }?>
                <?php if (in_array(Status::ACTION_ACCEPT, $actions)) {?>
                    <button class="button button__big-color request-button open-modal"
                        type="button" data-for="complete-form">Завершить</button>
                <?php }?>
                <?php if (in_array(Status::ACTION_CANCEL, $actions)) {?>
                    <a href="<?=Url::to(['tasks/cancel', 'taskId' => $task->id])?>"
                        class="button button__big-color refusal-button" type="button">Отменить</a>
                <?php }?>
            </div>
        </div>
        <?php if (count($task->replies) && \Yii::$app->user->getId() === $task->author_id) { ?>
        <div class="content-view__feedback">
            <h2>Отклики <span>(<?=count($task->replies)?>)</span></h2>
            <div class="content-view__feedback-wrapper">
            <?php foreach($task->getReplies()->orderBy(['created_at' => SORT_DESC])->all() as $reply) {
                print $this->render('singleReply', ['reply' => $reply, 'task' => $task]);
            } ?>
            </div>
        </div>
        <?php } ?>
        <?php $myReply = Reply::find()->where(['author_id' => \Yii::$app->user->getId(), 'task_id' => $task->id])->one() ?>
        <?php if ($myReply) { ?>
            <div class="content-view__feedback">
                <h2>Мой отклик</h2>
                <div class="content-view__feedback-wrapper">
                    <div class="content-view__feedback-card">
                        <div class="feedback-card__top">
                            <a href="#"><img src="<?=Path::toAvatar($myReply->author)?>" width="55" height="55"></a>
                            <div class="feedback-card__top--name">
                                <p><a href="#" class="link-regular"><?=Html::encode($myReply->author->name)?></a></p>
                                <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                                <b>4.25</b>
                            </div>
                            <span class="new-task__time"><?=$formatter->asRelativeTime($myReply->created_at)?></span>
                        </div>
                        <div class="feedback-card__content">
                            <p>
                            <?=Html::encode($myReply->description)?>
                            </p>
                            <span><?=Html::encode($myReply->rate)?> ₽</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <section class="connect-desk">
        <div class="connect-desk__profile-mini">
            <div class="profile-mini__wrapper">
                <h3>Заказчик</h3>
                <div class="profile-mini__top">
                    <img src="<?=Path::toAvatar($task->author)?>" width="62" height="62" alt="Аватар заказчика">
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
                    <p class="chat__message-text">Привет. Во сколько сможешь приступить к работе?</p>
                </div>
                <div class="chat__message chat__message--in">
                    <p class="chat__message-time">10.05.2019, 14:57</p>
                    <p class="chat__message-text">На задание выделены всего сутки, так что через час</p>
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


    <section class="modal response-form form-modal" id="response-form">
        <h2>Отклик на задание</h2>
        <?php $form = ActiveForm::begin(['id' => 'reply-form']) ?>
            <p>
                <?php $field = new ActiveField([
                    'form' => $form,
                    'model' => $replyForm,
                    'attribute' => 'rate',
                    'labelOptions' => ['class' => 'form-modal-description show-reply-label'],
                    'inputOptions' => ['class' => 'response-form-payment input input-middle input-money']
                ]);
                print $field->textInput() ?>
            </p>
            <p>
                <?php $field = new ActiveField([
                            'form' => $form,
                            'model' => $replyForm, 
                            'attribute' => 'comment',
                            'options' => ['tag' => false],
                            'labelOptions' => ['class' => 'form-modal-description show-reply-label'],
                            'inputOptions' => [
                                'class' => 'input textarea', 
                                'rows' => '4', 
                                'placeholder' => 'Могу выполнить работу быстро и качественно'
                            ],
                        ]);
                        print $field->textarea() ?>
            </p>
            <?= Html::submitButton('Отправить', ['class' => 'button modal-button']) ?>
        <?php ActiveForm::end() ?>
        <button class="form-modal-close" type="button">Закрыть</button>
    </section>


    <section class="modal completion-form form-modal" id="complete-form">
        <h2>Завершение задания</h2>
        <p class="form-modal-description">Задание выполнено?</p>
        <?php $form = ActiveForm::begin(['id' => 'opinion-form']) ?>
        <?php $field = new ActiveField([
            'form' => $form,
            'model' => $opinionForm,
            'attribute' => 'result',
            'template' => "{input}",
            'options' => ['tag' => false],
        ]);
        print $field->radioList($opinionForm->getResultList(), [
            'item' => function($index, $label, $name, $checked, $value) {
                $radioInput = Html::radio($name, $checked, [
                    'class' => "visually-hidden completion-input completion-input--difficult", 
                    'id' => $index,
                    'value' => $value
                ]);
                $radioLabel = Html::label($label, $index, ['class' => 'completion-label completion-label--difficult']);
                return $radioInput.$radioLabel;
            }
        ]); ?>
        <!-- <input class="visually-hidden completion-input completion-input--yes" type="radio" id="completion-radio--yes" name="completion" value="yes">
        <label class="completion-label completion-label--yes" for="completion-radio--yes">Да</label>
        <input class="visually-hidden completion-input completion-input--difficult" type="radio" id="completion-radio--yet" name="completion" value="difficulties">
        <label  class="completion-label completion-label--difficult" for="completion-radio--yet">Возникли проблемы</label> -->
        <p>
            <?php $field = new ActiveField([
                'form' => $form,
                'model' => $opinionForm, 
                'attribute' => 'comment',
                'options' => ['tag' => false],
                'labelOptions' => ['class' => 'form-modal-description'],
                'inputOptions' => [
                    'class' => 'input textarea', 
                    'rows' => '4', 
                    'placeholder' => 'Работа выполнена быстро и качественно. Большое спасибо'
                ],
            ]);
            print $field->textarea() ?>
        </p>
        <p class="form-modal-description">
            Оценка
            <div class="feedback-card__top--name completion-form-star">
                <span class="star-disabled"></span>
                <span class="star-disabled"></span>
                <span class="star-disabled"></span>
                <span class="star-disabled"></span>
                <span class="star-disabled"></span>
            </div>
        </p>
        <?php $field = new ActiveField([
                'form' => $form,
                'model' => $opinionForm, 
                'attribute' => 'rate',
                'template' => "{input}",
                'options' => ['tag' => false],
                'inputOptions' => ['id' => 'rating']
        ]);
        print $field->hiddenInput() ?>
        <?= Html::submitButton('Отправить', ['class' => 'button modal-button']) ?>
        <?php ActiveForm::end() ?>
        <button class="form-modal-close" type="button">Закрыть</button>
    </section>


    <section class="modal form-modal refusal-form" id="refuse-form">
        <h2>Отказ от задания</h2>
        <p>
            Вы собираетесь отказаться от выполнения задания.
            Это действие приведёт к снижению вашего рейтинга.
            Вы уверены?
        </p>
        <button class="button__form-modal button" id="close-modal" type="button">Отмена</button>
        <?= Html::beginForm(['tasks/refuse', 'taskId' => $task->id], 'post') ?>
        <?= Html::submitButton('Отказаться', ['class' => 'button__form-modal refusal-button button']) ?>
        <?= Html::endForm() ?>
        <button class="form-modal-close" type="button">Закрыть</button>
    </section>