<?php

use admin\assets\AppAsset;
use TiNavbar\widgets\Flash;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);
$user = Yii::$app->user->identity;
$access_token = $user ? $user->access_token : 'NOPE';
$this->registerJs("var admin_url='" . ADMIN . "';", View::POS_HEAD, 'admin-url');
$this->registerJs("var rest_url='" . REST . "';", View::POS_HEAD, 'rest-url');
$this->registerJs("var api_url='" . API . "';", View::POS_HEAD, 'api-url');
$this->registerJs(
	"var access_token='" . $access_token . "';",
	View::POS_HEAD,
	'access-token'
);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
	<meta charset="<?= Yii::$app->charset ?>" />
	<meta name="google" content="notranslate" />
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />
	<meta http-equiv="Content-Language" content="en_US" />
	<meta name="google" content="notranslate" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo Html::csrfMetaTags() ?>
	<title>
		<?= Html::encode(\Yii::$app->controller->view->title) ?>
	</title>
	<meta name="author" content="Toru Interactive ltd. Web, Mobile & Cloud Development. https://admin.toruinteractive.com">
	<?php $this->head() ?>
</head>

<body class="<?= Yii::$app->controller->id . '-' . Yii::$app->controller->action->id ?>">
	<?php
	$this->beginBody();

	echo $this->render('./main/_nav.php');
	echo Flash::widget();
	?>

	<div class="wrap">
		<?= $content ?>
	</div>

	<?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
