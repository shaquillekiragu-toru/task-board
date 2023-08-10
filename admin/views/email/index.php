<?php

use TiSearch\search\Search;

$this->title = \Yii::t('app', 'email');
?>
<div class="container">
	<?= Search::widget(['endpoint' => REST . '/emails']); ?>
</div>
