<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

/**
 * @var yii\web\View $this
 * @var \frontend\models\TaskForm $taskForm
 * @var \frontend\models\FileForm $fileForm
 */

$this->title = 'Новое задание';
?>
            <section class="create__task">
                <h1>Публикация нового задания</h1>
                <div class="create__task-main">
                    <?php $form = ActiveForm::begin([
                            'id' => 'create-form',
                            'options' => [
                                'class' => 'create__task-form form-create',
                                'enctype' => 'multipart/form-data'
                            ]
                        ])?>

                        <?php $field = new ActiveField([
                            'form' => $form,
                            'model' => $taskForm, 
                            'attribute' => 'name',
                            'options' => ['class' => 'create-tag'],
                            'inputOptions' => [
                                'class' => 'input textarea field-taskform-name create-input', 
                                'rows' => '1', 
                                'placeholder' => 'Повесить полку'
                            ],
                            'hintOptions' => ['tag' => 'span']
                        ]);
                        print $field->textarea()->hint('Кратко опишите суть работы') ?>

                        <?php $field = new ActiveField([
                            'form' => $form,
                            'model' => $taskForm, 
                            'attribute' => 'description',
                            'options' => ['class' => 'create-tag'],
                            'inputOptions' => [
                                'class' => 'input textarea field-taskform-description create-input', 
                                'rows' => '7', 
                                'placeholder' => 'Полку надо повесить на высоте не менее двух метров'
                            ],
                            'hintOptions' => ['tag' => 'span']
                        ]);
                        print $field->textarea()->hint('Укажите все пожелания и детали, чтобы исполнителям было проще соориентироваться') ?>
                        
                        <?php $field = new ActiveField([
                            'form' => $form,
                            'model' => $taskForm, 
                            'attribute' => 'category_id',
                            'options' => ['class' => 'create-tag'],
                            'inputOptions' => [
                                'class' => 'multiple-select input multiple-select-big field-taskform-category_id create-input-category', 
                                'size' => '1'],
                            'hintOptions' => ['tag' => 'span']
                        ]);
                        print $field->dropDownList($taskForm->getCategoryList())->hint('Выберите категорию') ?>

                        <?php $field = new ActiveField([
                            'form' => $form,
                            'model' => $taskForm, 
                            'attribute' => 'file',
                            'options' => ['class' => 'create-tag'],
                            'template' => "{label}\n{hint}\n{input}\n{error}",
                            'inputOptions' => ['class' => 'create__file'],
                            'hintOptions' => ['tag' => 'span', 'class' => 'create-input-file-span']
                        ]);
                        print $field->fileInput()->hint('Загрузите файлы, которые помогут исполнителю лучше выполнить или оценить работу') ?>

                        <label for="13">Локация</label>
                        <input class="input-navigation input-middle input" id="13" type="search" name="q" placeholder="Санкт-Петербург, Калининский район">
                        <span>Укажите адрес исполнения, если задание требует присутствия</span>

                        <div class="create__price-time">
                            <?php $field = new ActiveField([
                                'form' => $form,
                                'model' => $taskForm, 
                                'attribute' => 'budget',
                                'options' => ['class' => 'create__price-time--wrapper'],
                                'inputOptions' => [
                                    'class' => 'input textarea input-money field-taskform-budget', 
                                    'rows' => '1', 
                                    'placeholder' => '1000'
                                ],
                                'hintOptions' => ['tag' => 'span']
                            ]);
                            print $field->textarea()->hint('Не заполняйте для оценки исполнителем');

                            $field = new ActiveField([
                                'form' => $form,
                                'model' => $taskForm, 
                                'attribute' => 'expire',
                                'options' => ['class' => 'create__price-time--wrapper'],
                                'inputOptions' => ['class' => 'input-middle input input-date field-taskform-created_at'],
                                'hintOptions' => ['tag' => 'span']
                            ]);
                            print $field->input('date')->hint('Укажите крайний срок исполнения') ?>
                        </div>
                    <?php ActiveForm::end() ?>
                    <div class="create__warnings">
                        <div class="warning-item warning-item--advice">
                            <h2>Правила хорошего описания</h2>
                            <h3>Подробности</h3>
                            <p>Друзья, не используйте случайный<br>
                                контент – ни наш, ни чей-либо еще. Заполняйте свои
                                макеты, вайрфреймы, мокапы и прототипы реальным
                                содержимым.</p>
                            <h3>Файлы</h3>
                            <p>Если загружаете фотографии объекта, то убедитесь,
                                что всё в фокусе, а фото показывает объект со всех
                                ракурсов.</p>
                        </div>
                        <div class="warning-item warning-item--error">
                            <h2>Ошибки заполнения формы</h2>
                            <?php foreach ($taskForm->getErrorSummary(true) as $name => $error) {
                                print Html::tag('h3', $name);
                                print Html::tag('p', $error);
                            } ?>
                        </div>
                    </div>
                </div>
                <?=Html::submitButton('Опубликовать', ['class' => 'button', 'form' => 'create-form']) ?>
            </section>