<?php

use yii\helpers\Html;

?>

<div class="container mx-auto">
    <h1 class="mb-5">Task Board</h1>
    <div class="grid grid-cols-3 gap-4 p-4">
        <div class="flex flex-col gap-4">
            <? foreach ($tasks as $task) { ?>
                <div class="flex flex-col gap-2 p-2">
                    <h2 class="text-lg font-bold"><?= $task->title ?></h2>
                    <p class="text-sm text-gray-500"><?= $task->description ?></p>
                </div>
            <? } ?>
        </div>
    </div>
</div>