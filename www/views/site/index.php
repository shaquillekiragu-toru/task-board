<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="container mx-auto">
    <div class="w-full flex justify-end mb-5">
        <a href="<?= Url::to(['task/create']) ?>" class="bg-green-500 text-white px-4 py-2 rounded-md">Create a New Task</a>
    </div>
    <div class="w-full flex justify-center mb-10">
        <h1 class="text-4xl font-bold">Task Board</h1>
    </div>
    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 p-12 border-2 border-black rounded-xl">
        <?php foreach ($tasksByStatus as $status => $tasks) { ?>
            <div class="flex flex-col gap-4 p-8 border-2 border-black rounded-lg min-h-[500px]">
                <h2 class="w-full text-center text-2xl font-bold mb-5"><?= $status ?></h2>
                <?php foreach ($tasks as $task) : ?>
                    <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                        <div class="w-full flex justify-between">
                            <p class="text-sm text-blue-500"><?= $task->assigned_user_id ?></p>
                            <p class="text-sm text-gray-500">Due: <?= $task->due_date ?></p>
                        </div>
                        <div class="w-full flex justify-center">
                            <p class="text-lg font-bold"><?= $task->title ?></p>
                        </div>
                        <div class="w-full flex justify-start">
                            <p class="text-sm text-gray-500"><?= $task->description ?></p>
                        </div>
                        <div class="w-full flex justify-between">
                            <a href="<?= Url::to(['task/update', 'id' => $task->id]) ?>" class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</a>
                            <a href="<?= Url::to(['task/delete', 'id' => $task->id]) ?>" class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php } ?>
    </div>
</div>