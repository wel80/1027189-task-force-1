<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

/**
 * @var yii\web\View $this
 * @var \frontend\models\Task[] $tasks
 */

$this->title = 'Новые задания';
?>
            <section class="new-task">
                <div class="new-task__wrapper">
                    <h1>Новые задания</h1>
                    <?php foreach($tasks as $task) {
                        print $this->render('singleTask', ['task' => $task]);
                    } ?>
                </div>
                <div class="new-task__pagination">
                    <ul class="new-task__pagination-list">
                        <li class="pagination__item"><a href="#"></a></li>
                        <li class="pagination__item pagination__item--current">
                            <a>1</a></li>
                        <li class="pagination__item"><a href="#">2</a></li>
                        <li class="pagination__item"><a href="#">3</a></li>
                        <li class="pagination__item"><a href="#"></a></li>
                    </ul>
                </div>
            </section>
            <section  class="search-task">
                <div class="search-task__wrapper">
                    <?php $form = ActiveForm::begin(['id' => 'tasks-filter-form', 'options' => ['class' => 'search-task__form']]); ?>
                        <fieldset class="search-task__categories">
                            <legend>Категории</legend>
                            <?php $field = new ActiveField([
                                'form' => $form,
                                'model' => $model, 
                                'attribute' => 'categories',
                                'template' => "{input}",
                                'options' => ['tag' => false]
                            ]);
                            print $field->checkboxList($model->getCategoryList(), [
                                'item' => function($index, $label, $name, $checked, $value) {
                                    $checkbox = Html::checkbox($name, $checked, [
                                        'class' => "visually-hidden checkbox__input", 
                                        'id' => 'C'.$index,
                                        'value' => $value
                                    ]);
                                    $checkboxLabel = Html::label($label, 'C'.$index);
                                    return $checkbox.$checkboxLabel;
                                }
                            ]);?>
                        </fieldset>
                        <fieldset class="search-task__categories">
                            <legend>Дополнительно</legend>
                            <?php $field = new ActiveField([
                                'form' => $form,
                                'model' => $model, 
                                'attribute' => 'additionally',
                                'template' => "{input}",
                                'options' => ['tag' => false]
                            ]);
                            print $field->checkboxList($model->getAdditionallyList(),[
                                'item' => function($index, $label, $name, $checked, $value) {
                                    $checkbox = Html::checkbox($name, $checked, [
                                        'class' => "visually-hidden checkbox__input", 
                                        'id' => 'A'.$index,
                                        'value' => $value
                                    ]);
                                    $checkboxLabel = Html::label($label, 'A'.$index);
                                    return $checkbox.$checkboxLabel;
                                }
                            ]);?>
                        </fieldset>
                        <?php 
                            $field = new ActiveField([
                                'form' => $form,
                                'model' => $model, 
                                'attribute' => 'period',
                                'template' => "{label}\n{input}",
                                'options' => ['tag' => false],
                                'labelOptions' => ['class' => 'search-task__name'],
                                'inputOptions' => ['class' => 'multiple-select input']
                            ]);
                            print $field->dropDownList($model->getPeriodList());

                            $field = new ActiveField([
                                'form' => $form,
                                'model' => $model, 
                                'attribute' => 'search',
                                'template' => "{label}\n{input}",
                                'options' => ['tag' => false],
                                'labelOptions' => ['class' => 'search-task__name'],
                                'inputOptions' => ['class' => 'input-middle input']
                            ]);
                            print $field->textInput();
                            
                            print Html::submitButton('Искать', ['class' => 'button']);
                        ?>
                    <?php ActiveForm::end() ?>
                </div>
            </section>