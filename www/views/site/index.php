<?php

use yii\helpers\Html;
?>
<div class="container mx-auto">
    <div class="w-full flex justify-end mb-5">
        <button class="bg-green-500 text-white px-4 py-2 rounded-md">Create a New Task</button>
    </div>
    <h1 class="w-full text-center mb-10 text-4xl font-bold">Task Board</h1>
    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 p-12 border-2 border-black rounded-xl">

        <div class="flex flex-col gap-4 p-8 border-2 border-black rounded-lg min-h-[500px]">
            <h2 class="w-full text-center text-xl font-bold mb-5">To Do</h2>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 1</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 1</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 2</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 2</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 3</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 3</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 4</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 4</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 p-8 border-2 border-black rounded-lg min-h-[500px]">
            <h2 class="w-full text-center text-xl font-bold mb-5">In Progress</h2>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 5</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 5</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 6</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 6</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 7</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 7</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 8</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 8</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 p-8 border-2 border-black rounded-lg min-h-[500px]">
            <h2 class="w-full text-center text-xl font-bold mb-5">Done</h2>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 9</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 9</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 10</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 10</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 11</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 11</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
            <div class="w-full flex flex-col gap-6 p-4 border border-black rounded-lg bg-white">
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold">Title 12</h3>
                    <p class="text-sm text-gray-500">Due: 2025-06-03</p>
                </div>
                <div class="w-full">
                    <p class="text-sm text-gray-500">Description 12</p>
                </div>
                <div class="flex justify-between">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
        </div>

    </div>
</div>