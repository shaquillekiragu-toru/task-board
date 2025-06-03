<?php

use yii\helpers\Url;

$this->title = $model->first_name . " " . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => Url::to('/user')];
$this->params['breadcrumbs'][] = $this->title;

$this->params['actions'][] = [
	'icon' => 'trash',
	'url' => Url::to('/user/delete/' . $model->id),
];

?>
<div class="container">
	<?= $this->render('_tabs', ['tab' => $tab, 'model' => $model]); ?>
	<div class="tab-content">
		<br>
		<div role="tabpanel" class="tab-pane <?= $tab == 'overview' ? 'active' : ''; ?>" id="overview">
			<?= $this->render('view/_overview', ['model' => $model]); ?>
		</div>
		<div role="tabpanel" class="tab-pane <?= $tab == 'logins' ? 'active' : ''; ?>" id="logins">
			<?= $this->render('view/_logins', ['model' => $model]); ?>
		</div>
	</div>
</div>