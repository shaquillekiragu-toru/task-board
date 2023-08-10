<?php

use yii\helpers\Url;

?>

<table class="table table-bordered">
	<tr>
		<th>
			Date
		</th>
		<th>
			Platform
		</th>
		<th>
			IP
		</th>
	</tr>
	<?php foreach (array_reverse($model->userSigninActivities) as $signin) { ?>
		<tr>
			<td>
				<?= date("d/m/Y, H:i", $signin->timestamp) ?>
			</td>
			<td>
				<?= $signin->browser ?>
				<?= $signin->version ?> on
				<?= $signin->platform ?>
			</td>
			<td>
				<?= $signin->ip ?>
			</td>
		</tr>
	<?php } ?>
</table>
