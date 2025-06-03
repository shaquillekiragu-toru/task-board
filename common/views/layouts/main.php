<?php

use yii\helpers\Html;
use yii\web\View;

$user = Yii::$app->user->identity;
$access_token = $user ? $user->access_token : 'NOPE';
$this->registerJs('var admin_url="' . ADMIN . '";', View::POS_HEAD, 'admin-url');
$this->registerJs('var rest_url="' . REST . '";', View::POS_HEAD, 'rest-url');
$this->registerJs('var api_url="' . API . '";', View::POS_HEAD, 'api-url');
$this->registerJs('var access_token="' . $access_token . '";', View::POS_HEAD, 'access-token');

$this->beginPage();
?>
<!DOCTYPE html>
<html lang='<?= Yii::$app->language ?>' class='bg-base-300 preview' data-theme-force='winter' data-theme="<?= 'winter' /*key_exists('data-set-theme', $_COOKIE) ? $_COOKIE['data-set-theme'] : 'wireframe'*/ ?>">

<head>
	<meta charset='<?= Yii::$app->charset ?>' />
	<meta name='google' content='notranslate' />
	<link rel='icon' type='image/png' href='/favicon-32x32.png' sizes='32x32' />
	<link rel='icon' type='image/png' href='/favicon-16x16.png' sizes='16x16' />
	<meta http-equiv='Content-Language' content='en_US' />
	<meta name='google' content='notranslate' />
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<?php echo Html::csrfMetaTags() ?>
	<title>
		<?= Html::encode(\Yii::$app->controller->view->title) ?>
	</title>

	<link href="https://cdn.jsdelivr.net/npm/daisyui@2.52.0/dist/full.css" rel="stylesheet" type="text/css" />

	<script src="https://unpkg.com/flowbite@latest/dist/flowbite.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/flowbite@latest/dist/flowbite.min.css" />

	<script src="https://unpkg.com/flowbite@latest/dist/datepicker.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements@1.0.0-beta1/dist/css/index.min.css" />
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel='stylesheet' as='stylesheet' crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/heroicons-css@0.1.1/heroicons.css">
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<meta name='author' content='Toru Interactive ltd. Web, Mobile & Cloud Development. https://admin.toruinteractive.com'>
	<?php $this->head() ?>
</head>

<body class='<?= Yii::$app->controller->id . '-' . Yii::$app->controller->action->id ?> min-h-screen flex flex-col justify-between'>
	<div>
		<?php $this->beginBody() ?>
		<?= $this->render('./main/_nav.php') ?>

		<?php if (Yii::$app->params['no-container']) { ?>
			<?= $content ?>
		<?php } else { ?>
			<div class='wrap <?= (isset(Yii::$app->params['wrap-height']) && Yii::$app->params['wrap-height']) ? '' : 'mb-32' ?> mt-16'>
				<div class='mx-auto w-full sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl text-normal'>
					<?= $content ?>
				</div>
			</div>
		<?php } ?>
		<?php $this->endBody(); ?>
		<input id="tmp-file" type="file" name="tmp-file" style="display: none;" onchange="" />
		<?= $this->render('./main/_popup.php') ?>
	</div>

	<div>
		<p class='text-right text-gray-400 mr-3 <?= YII_DEBUG ? 'mb-12' : 'mb-2' ?>'>Version: <?= VERSION ?></p>
	</div>

</body>

</html>
<?php $this->endPage(); ?>