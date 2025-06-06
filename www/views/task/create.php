<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Task';
?>

<div class="max-w-none md:container mx-auto px-10">
    <h1 class="w-full text-center mb-10 text-4xl font-bold"><?= Html::encode($this->title) ?></h1>

    <div class="max-w-2xl mx-auto *:flex *:flex-col *:gap-5">
        <?php $form = ActiveForm::begin(); ?>

        <div>
            <?= $form->field($task, 'title')->textInput(['class' => 'w-full p-2 border rounded']) ?>
        </div>

        <div>
            <?= $form->field($task, 'description')->textarea(['class' => 'w-full p-2 border rounded', 'rows' => 4]) ?>
        </div>

        <div>
            <?= $form->field($task, 'status')->dropDownList([
                'To Do' => 'To Do',
                'In Progress' => 'In Progress',
                'Done' => 'Done'
            ], ['class' => 'w-full p-2 border rounded']) ?>
        </div>

        <div>
            <?= $form->field($task, 'due_date')->input('date', [
                'class' => 'w-full p-2 border rounded',
                'value' => $task->formattedDueDate
            ]) ?>
        </div>

        <div class="flex justify-between">
            <?= Html::submitButton('Create', ['class' => 'bg-green-500 text-white px-6 py-2 rounded-md']) ?>
            <?= Html::a('Cancel', ['task/index'], ['class' => 'bg-gray-500 text-white px-6 py-2 rounded-md']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>