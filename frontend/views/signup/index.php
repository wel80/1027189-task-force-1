<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var \frontend\models\RegistrationForm $userForm
 */

$this->title = 'Регистрация';
?>
            <section class="registration__user">
                <h1>Регистрация аккаунта</h1>
                <div class="registration-wrapper">
                    <?php $form = ActiveForm::begin([
                        'id' => 'registration-form',
                        'options' => ['class' => 'registration__user-form form-create']
                    ]);
                        $field = new ActiveField([
                            'form' => $form,
                            'model' => $userForm, 
                            'attribute' => 'email',
                            'inputOptions' => [
                                'class' => 'input textarea signup-input', 
                                'rows' => '1', 
                                'placeholder' => 'address@mail.com'
                            ],
                            'hintOptions' => ['tag' => 'span']
                        ]);
                        print $field->textarea()->hint('Введите валидный адрес электронной почты');

                        $field = new ActiveField([
                            'form' => $form,
                            'model' => $userForm, 
                            'attribute' => 'name',
                            'options' => ['class' => 'signup-tag'],
                            'inputOptions' => [
                                'class' => 'input textarea signup-input', 
                                'rows' => '1',
                                'placeholder' => 'Иванов Сергей Петрович'
                            ],
                            'hintOptions' => ['tag' => 'span']
                        ]);
                        print $field->textarea()->hint('Введите ваше имя и фамилию');

                        $field = new ActiveField([
                            'form' => $form,
                            'model' => $userForm, 
                            'attribute' => 'city_id',
                            'options' => ['class' => 'signup-tag'],
                            'inputOptions' => [
                                'class' => 'multiple-select input town-select registration-town signup-input-city', 
                                'size' => '1'
                            ],
                            'hintOptions' => ['tag' => 'span']
                        ]);
                        print $field->dropDownList($userForm->getCityList())->hint('Укажите город, чтобы находить подходящие задачи');

                        $field = new ActiveField([
                            'form' => $form,
                            'model' => $userForm, 
                            'attribute' => 'password',
                            'options' => ['class' => 'signup-tag'],
                            'inputOptions' => ['class' => 'input textarea signup-input'],
                            'hintOptions' => ['tag' => 'span']
                        ]);
                        print $field->passwordInput()->hint('Придумайте пароль');

                        print Html::submitButton('Cоздать аккаунт', ['class' => 'button button__registration']);

                    ActiveForm::end() ?>
                </div>
            </section>

            <div class="clipart-woman">
                <img src="<?=Url::to("/img/clipart-woman.png")?>" width="238" height="450">
            </div>
            <div class="clipart-message">
                <div class="clipart-message-text">
                <h2>Знаете ли вы, что?</h2>
                <p>После регистрации вам будет доступно более
                    двух тысяч заданий из двадцати разных категорий.</p>
                    <p>В среднем, наши исполнители зарабатывают
                    от 500 рублей в час.</p>
                </div>
            </div>