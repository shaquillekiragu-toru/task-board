<?php

namespace admin\assets;

use yii\web\AssetBundle;

class TippyAsset extends AssetBundle {
	public $js = [
		"https://unpkg.com/tippy.js@6"
	];

	public $depends = ["admin\assets\PopperJSAsset"];
}
