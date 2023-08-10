<?php

use yii\helpers\Url;

$cancel_link = Url::to(['view', 'id' => $model->id]);

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['/user']];
$this->params['breadcrumbs'][] = ['label' => $model->full_name, 'url' => $cancel_link];
$this->params['breadcrumbs'][] = $this->title;


echo '<div class="container">';
echo $this->render('_form', [
	'model' => $model,
	'organisations' => $organisations,
	'cancel_link' => $cancel_link
]);
echo '</div>';
