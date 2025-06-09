<?php

namespace www\assets;

use yii\web\AssetBundle;
use Yii;

class TailwindAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        '/css/tailwind.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];

    public function init()
    {
        parent::init();
        $this->css[0] .= '?v=' . (Yii::$app->params['cacheKey'] ?? time());
    }
}
