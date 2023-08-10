<?php

namespace admin\assets;

use yii\web\AssetBundle;

class ChartJSAsset extends AssetBundle {
	public $js = [
		"https://cdn.jsdelivr.net/npm/chart.js@2.8.0"
	];

	public $depends = ["admin\assets\MomentJSAsset"];
}
