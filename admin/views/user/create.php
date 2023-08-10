<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Create User';

echo '<div class="container">';
echo $this->render('_form', [
	'model' => $model,
	'organisations' => $organisations,
	'btn' => 'success',
	'cancel_link' => '/user',
	'submit' => 'Create'
]);
echo '</div>';
