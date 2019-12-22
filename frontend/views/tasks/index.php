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
                    <?php ActiveForm::begin(['id' => 'tasks-filter-form', 'options' => ['class' => 'search-task__form']]); ?>
                        <fieldset class="search-task__categories">
                            <?php $field = new ActiveField([
                                'model' => $model, 
                                'attribute' => 'category',
                                'labelOptions' => ['class' => 'search-task__name']
                            ]);
                            print $field->checkboxList($model->getCategoryList()); ?>
                        </fieldset>
                        <fieldset class="search-task__categories">
                            <?php $field = new ActiveField([
                                'model' => $model, 
                                'attribute' => 'additionally',
                                'labelOptions' => ['class' => 'search-task__name']
                            ]);
                            print $field->checkboxList($model->getAdditionallyList()); ?>
                        </fieldset>
                        <fieldset class="search-task__categories">
                        <?php 
                            $field = new ActiveField([
                                'model' => $model, 
                                'attribute' => 'period',
                                'labelOptions' => ['class' => 'search-task__name']
                            ]);
                            print $field->dropdownList($model->getPeriodList());

                            $field = new ActiveField([
                                'model' => $model, 
                                'attribute' => 'search',
                                'labelOptions' => ['class' => 'search-task__name']
                            ]);
                            print $field->textInput();
                            
                            print Html::submitButton('Искать', ['class' => 'button']);
                        ?>
                        </fieldset>
                    <?php ActiveForm::end() ?>
                </div>
            </section>