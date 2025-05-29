<?php

namespace www\assets;

use yii\web\AssetBundle;

class TailwindAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = ['/css/tailwind.css?v=' . CACHE_KEY];
}
