<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="max-w-none md:container mx-auto px-10">
    <div class="w-full flex justify-end mb-5">
        <a href="<?= Url::to(['task/create']) ?>" class="bg-green-500 text-white px-4 py-2 rounded-md">Create a New Task</a>
    </div>
    <div class="w-full flex justify-center mb-10">
        <h1 class="text-4xl font-bold">Task Board</h1>
    </div>
    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 p-8 md:p-12 border-2 border-black rounded-xl">
        <?php foreach ($tasksByStatus as $status => $tasks) { ?>
            <div class="flex flex-col gap-4 p-6 md:p-8 border-2 border-black rounded-lg min-h-[500px]">
                <h2 class="w-full text-center text-2xl font-bold mb-5"><?= $status ?></h2>
                <?php foreach ($tasks as $task) { ?>
                    <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                        <div class="w-full flex justify-around">
                            <p class="text-sm text-gray-500">Created: <?= $task->formattedCreatedAt ?></p>
                            <p class="text-sm text-gray-500">Due: <?= $task->formattedDueDate ?></p>
                        </div>
                        <div class="w-full flex justify-center">
                            <p class="text-lg font-bold"><?= $task->title ?></p>
                        </div>
                        <div class="w-full flex justify-start">
                            <p class="text-sm text-gray-500"><?= $task->description ?></p>
                        </div>
                        <div class="w-full flex justify-center">
                            <p class="text-md text-green-500">Assigned to: <?= $task->assignedUser ? $task->assignedUser->full_name : 'Unassigned' ?></p>
                        </div>
                        <div class="w-full flex justify-between">
                            <a href="<?= Url::to(['task/update', 'id' => $task->id]) ?>" class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</a>
                            <a href="<?= Url::to(['task/delete', 'id' => $task->id]) ?>" class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>