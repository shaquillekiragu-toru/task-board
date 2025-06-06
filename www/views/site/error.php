<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception|null */

$this->title = $name;
?>
<div class="min-h-[60vh] flex items-center justify-center">
    <div class="text-center">
        <div class="mb-8">
            <div class="text-9xl font-bold text-error"><?= Html::encode(substr($name, 0, 3)) ?></div>
            <h1 class="text-4xl font-bold mt-4 mb-2"><?= Html::encode($name) ?></h1>
            <div class="text-xl text-gray-600 mb-8"><?= nl2br(Html::encode($message)) ?></div>
        </div>

        <div class="flex justify-center gap-4">
            <a href="<?= Url::home() ?>" class="btn btn-primary">
                <i class="heroicon-o-home mr-2"></i>
                Back to Home
            </a>
            <button onclick="history.back()" class="btn btn-outline">
                <i class="heroicon-o-arrow-left mr-2"></i>
                Go Back
            </button>
        </div>

        <?php if (YII_DEBUG && $exception !== null): ?>
            <div class="mt-8 p-4 bg-base-200 rounded-lg text-left">
                <h2 class="text-xl font-bold mb-2">Exception Details:</h2>
                <pre class="text-sm overflow-auto"><?= Html::encode($exception->getMessage()) ?></pre>
            </div>
        <?php endif; ?>
    </div>
</div>