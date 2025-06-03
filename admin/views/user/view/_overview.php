<?php

use yii\helpers\Url;

?>
<table class="table table-bordered">
	<tr>
		<th width="25%">Name</th>
		<td>
			<?= $model->full_name; ?>
		</td>
	</tr>

	<tr>
		<th>
			<?= $model->getAttributeLabel('email'); ?>
		</th>
		<td>
			<?= $model->email; ?>
		</td>
	</tr>

	<tr>
		<th>
			<?= $model->getAttributeLabel('_role'); ?>
		</th>
		<td>
			<?= $model->_role; ?>
		</td>
	</tr>

	<tr>
		<th>
			<span data-toggle="tooltip" title="Note: You can't reset a user's password. Instead ask them to goto the login page and follow the 'forgot' link" class="glyphicon glyphicon-info-sign pull-right">
			</span>
			Password
		</th>
		<td>
			********
		</td>
	</tr>

</table>

<div class="pull-right">
	<?php if (Yii::$app->user->can('superadmin')) { ?>
		<a href="<?= Url::to('/user/loginas/' . $model->id) ?>" class="btn btn-danger">
			<span class="glyphicon glyphicon-eye-open"></span>
			login as
		</a>
	<?php } ?>
	<a href="<?= Url::to('/user/update/' . $model->id) ?>" class="btn btn-primary">
		<span class="glyphicon glyphicon-pencil"></span>
		edit
	</a>
</div>