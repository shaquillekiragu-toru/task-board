<div class="container mx-auto">
    <h1 class="mb-5">Task Board</h1>
    <div class="grid grid-cols-3 gap-4 p-4 border-2 border-black rounded-md">
        <div class="flex flex-col gap-2 border-2 border-black rounded-md">
            <? foreach ($tasks as $task) { ?>
                <div class="flex flex-col gap-2 p-2 border border-black rounded-md">
                    <h2 class="text-lg font-bold"><?= $task->title ?></h2>
                    <p class="text-sm text-gray-500"><?= $task->description ?></p>
                </div>
            <? } ?>
        </div>
    </div>
</div>