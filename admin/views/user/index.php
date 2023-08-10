<?php

use TiSearch\search\Search;
use yii\helpers\Url;
use common\models\User;

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

$this->params['actions'][] = [
	'label' => 'New User',
	'icon' => 'plus',
	'url' => Url::toRoute(['create'])
];
?>

<div class="container">
	<?= Search::widget(['endpoint' => REST . '/users']) ?>
</div>
