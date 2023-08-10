<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$cancel_link = Url::to('/user/view/' . $model->id);

$this->title = 'Delete';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['/user']];
$this->params['breadcrumbs'][] = ['label' => $model->full_name, 'url' => $cancel_link];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	<?php
	$form = ActiveForm::begin([
		'enableAjaxValidation' => false,
		'enableClientScript' => false
	]);

	echo $form
		->field($model, 'id')
		->label(false)
		->hiddenInput();
	?>
	<div class="col-md-6 col-md-offset-3">
		<div class="well">
			<div>
				Are you sure you want to delete
				<?= $model->full_name ?>?
			</div>
			<br>
			<div class="pull-right">
				<a href="<?= $cancel_link; ?>" class="btn btn-lg btn-ghost goStripey">cancel</a>&nbsp;
				<?= Html::submitButton('Do It', ['class' => 'btn btn-lg btn-danger goStripey']); ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>
