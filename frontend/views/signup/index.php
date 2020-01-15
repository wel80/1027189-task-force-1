<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

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
                        'action' => '/signup',
                        'options' => ['class' => 'registration__user-form form-create']
                    ]);
                        $field = new ActiveField([
                            'form' => $form,
                            'model' => $userForm, 
                            'attribute' => 'email',
                            'template' => "{label}\n{input}\n{error}",
                            'options' => ['tag' => false],
                            'inputOptions' => ['class' => 'input textarea', 'rows' => '1']
                        ]);
                        print $field->textarea();

                        $field = new ActiveField([
                            'form' => $form,
                            'model' => $userForm, 
                            'attribute' => 'name',
                            'template' => "{label}\n{input}\n{error}",
                            'options' => ['tag' => false],
                            'inputOptions' => ['class' => 'input textarea', 'rows' => '1']
                        ]);
                        print $field->textarea();

                        $field = new ActiveField([
                            'form' => $form,
                            'model' => $userForm, 
                            'attribute' => 'city_id',
                            'template' => "{label}\n{input}",
                            'options' => ['tag' => false],
                            'inputOptions' => ['class' => 'multiple-select input town-select registration-town', 'size' => '1']
                        ]);
                        print $field->dropDownList($userForm->getCityList());

                        $field = new ActiveField([
                            'form' => $form,
                            'model' => $userForm, 
                            'attribute' => 'password',
                            'template' => "{label}\n{input}\n{error}",
                            'options' => ['tag' => false],
                            'inputOptions' => ['class' => 'input textarea']
                        ]);
                        print $field->passwordInput();

                        print Html::submitButton('Cоздать аккаунт', ['class' => 'button button__registration']);

                    ActiveForm::end() ?>
                </div>
            </section>