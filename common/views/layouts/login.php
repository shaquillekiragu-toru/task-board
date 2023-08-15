<?php

use TiNavbar\widgets\Flash;
use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
	<meta charset="<?= Yii::$app->charset ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo Html::csrfMetaTags() ?>
	<title>Login</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<?php $this->head() ?>
</head>

<body class='site-login h-screen'>
	<?php $this->beginBody() ?>
	<?php echo Flash::widget(); ?>
	<div class="login">
		<?= $content ?>
	</div>
	<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>