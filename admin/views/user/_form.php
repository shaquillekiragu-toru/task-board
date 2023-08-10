<?php

use common\models\Organisation;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$organisations = Organisation::find()
	->select([
		'id',
		'title'
	])
	->asArray()
	->all();

$organisations = array_column($organisations, 'title', 'id');

?>
<br>
<br>
<div class="page-form">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<?php
			$form = ActiveForm::begin([
				'enableAjaxValidation' => false,
				'enableClientScript' => false
			]);
			?>
			<div class="well">
				<?php

				echo $form
					->field($model, 'first_name')
					->textInput();

				echo $form
					->field($model, 'last_name')
					->textInput();

				echo $form
					->field($model, 'email')
					->input('email');

				if ($model->isNewRecord) {
					echo $form
						->field($model, 'password')
						->passwordInput();
				}

				echo $form
					->field($model, 'role')
					->dropDownList($model->get_roles($isUserSuperadmin), ['prompt' => '']);
				?>
			</div>
			<br>
			<div class="pull-right">
				<a href="<?= $cancel_link ?>" class='btn btn-ghost goStripey'>cancel</a>
				<?= Html::submitButton('save', ['class' => 'btn btn-primary goStripey']); ?>
			</div>
			<div class="clearfix"></div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
