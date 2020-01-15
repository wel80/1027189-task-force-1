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
                            'inputOptions' => ['class' => 'input textarea', 'rows' => '1']
                        ]);
                        print $field->textarea();

                        $field = new ActiveField([
                            'form' => $form,
                            'model' => $userForm, 
                            'attribute' => 'name',
                            'inputOptions' => ['class' => 'input textarea', 'rows' => '1']
                        ]);
                        print $field->textarea();

                        $field = new ActiveField([
                            'form' => $form,
                            'model' => $userForm, 
                            'attribute' => 'city_id',
                            'inputOptions' => ['class' => 'multiple-select input town-select registration-town town-select-form', 'size' => '1']
                        ]);
                        print $field->dropDownList($userForm->getCityList());

                        $field = new ActiveField([
                            'form' => $form,
                            'model' => $userForm, 
                            'attribute' => 'password',
                            'inputOptions' => ['class' => 'input textarea']
                        ]);
                        print $field->passwordInput();

                        print Html::submitButton('Cоздать аккаунт', ['class' => 'button button__registration']);

                    ActiveForm::end() ?>
                </div>
            </section>