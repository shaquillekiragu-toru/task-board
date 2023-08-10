<?php
use yii\helpers\Url;

$this->title = $slug;
$this->params['breadcrumbs'][] = ['label' => 'Email', 'url' => '/email'];
$this->params['breadcrumbs'][] = $this->title;

$this->params['actions'][] = [
	'icon' => 'trash',
	'url' => Url::to('/sitesetting/delete/' . $model->id),
];
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-3">
			<a class='btn btn-primary' href="/email">
				<?= \Yii::t('app', 'back') ?>
			</a>
			<br>
			<br>
			<h4>
				<?= \Yii::t('app', 'options') ?>
			</h4>
			<div class='input-form'>

			</div>
		</div>
		<div class="col-xs-9">
			<div class="iframe">
				<iframe class='email-iframe'></iframe>
				<div class='iframe-data' data-src="/email/preview/<?= $slug ?>" data-details='<?= json_encode($json) ?>'></div>
			</div>
		</div>
	</div>
</div>

<style>
	.iframe {
		flex-grow: 1;
		background-color: #f1f1f1;
	}

	.iframe iframe {
		width: 100%;
		min-height: calc(100vh - 200px);
		border: 0;
	}
</style>
