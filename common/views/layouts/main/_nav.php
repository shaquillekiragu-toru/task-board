<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

extract(require \Yii::getAlias('@app/views/layouts/main/_nav.php'));

$breadcrumbs = Yii::$app->view->params['breadcrumbs'] ?? [];
$actions = Yii::$app->view->params['actions'] ?? [];
$active_link_icon = 'home';
foreach ($links as $link) {
	if ($link['active']) {
		$active_link_icon = $link['icon'];
	}
}

foreach ($breadcrumbs as $index => $breadcrumb) {
	if (is_string($breadcrumb)) {
		$breadcrumbs[$index] = [
			'url' => '#',
			'label' => $breadcrumb
		];
	}
}
?>


<div class="navbar bg-base-100 rounded-bl rounded-br h-16 z-50 shadow fixed top-0 left-0 w-screen">
	<div class="navbar-start">
		<div class="dropdown">
			<label tabindex="0" class="btn btn-ghost lg:hidden">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
				</svg>
			</label>
			<ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow-xl bg-base-100 rounded-box w-52">
				<?php foreach ($links as $link) { ?>
					<?= $this->render('./_menu.php', ['entry' => $link]) ?>
				<?php } ?>
			</ul>
		</div>

		<a href='<?= Url::toRoute('/') ?>' class="btn btn-ghost normal-case text-xl">
			<?= Yii::$app->name ?>
		</a>
		<?php if (YII_DEBUG) { ?>
			<p class='fixed top-16 left-2 text-red-400'>
				<span class='absolute top-0 left-0 opacity-50 sm:opacity-0 md:opacity-0 lg:opacity-0 xl:opacity-0 2xl:opacity-0'>gb</span>
				<span class='absolute top-0 left-0 opacity-0 sm:opacity-50 md:opacity-0 lg:opacity-0 xl:opacity-0 2xl:opacity-0'>sm</span>
				<span class='absolute top-0 left-0 opacity-0 sm:opacity-0 md:opacity-50 lg:opacity-0 xl:opacity-0 2xl:opacity-0'>md</span>
				<span class='absolute top-0 left-0 opacity-0 sm:opacity-0 md:opacity-0 lg:opacity-50 xl:opacity-0 2xl:opacity-0'>lg</span>
				<span class='absolute top-0 left-0 opacity-0 sm:opacity-0 md:opacity-0 lg:opacity-0 xl:opacity-50 2xl:opacity-0'>xl</span>
				<span class='absolute top-0 left-0 opacity-0 sm:opacity-0 md:opacity-0 lg:opacity-0 xl:opacity-0 2xl:opacity-50'>2xl</span>
			</p>
		<?php } ?>
	</div>
	<div class="navbar-center hidden lg:flex">
		<ul class="menu menu-horizontal p-0">
			<?php foreach ($links as $link) { ?>
				<?= $this->render('./_menu.php', ['entry' => $link]) ?>
			<?php } ?>
		</ul>
	</div>
	<div class="navbar-end">
		<?php if ($search) { ?>
			<div>
				<?php $form = ActiveForm::begin([
					'enableAjaxValidation' => false,
					'enableClientScript' => false,
					'action' => '/site/search',
					'method' => 'GET'
				]); ?>
				<div class='h-full'>
					<div class='hidden relative top-2 lg:block'>
						<div class='flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none'>
							<svg class='w-5 h-8 text-gray-500' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>
								<path fill-rule='evenodd' d='M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z' clip-rule='evenodd'></path>
							</svg>
						</div>
						<input name='term' type='text' class='block p-2 pl-10 w-full rounded-lg border sm:text-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-700 border-gray-600 placeholder-gray-400 text-content focus:ring-blue-500 focus:border-blue-500' placeholder='Search...'>
					</div>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		<?php } ?>
		<?= $this->render('./_theme.php') ?>
		<div class="dropdown dropdown-end">
			<label tabindex="0" class="btn btn-ghost btn-circle avatar mt-1 ml-2">
				<div class="w-9 h-9 rounded-full">
					<img src="<?= Yii::$app->user->identity->profilePicture ?>" />
				</div>
			</label>
			<ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow-xl bg-base-100 rounded-box w-52">
				<?php foreach ($cogmenu as $cog) { ?>
					<?php if ($cog != null) { ?>
						<?= $this->render('./_menu.php', ['entry' => $cog]) ?>
					<?php } ?>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>

<div class='block w-full h-24'></div>

<?php if (count($breadcrumbs) > 0 || count($actions) > 0) { ?>
	<div class='breadcrumbs mx-auto w-full sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl'>
		<div class='flex px-5 bg-base-100 rounded-lg justify-between h-16'>
			<nav class='flex py-3 px-5'>
				<ol class='inline-flex items-center space-x-1 md:space-x-3'>
					<?php foreach ($breadcrumbs as $index => $breadcrumb) { ?>
						<li class='inline-flex items-center'>
							<a href='<?= $breadcrumb['url'] ?>' class='inline-flex items-center text-sm font-medium text-<?= count($breadcrumbs) - 1 == $index ? 'primary' : 'content' ?>'>
								<?php if ($index == 0) { ?>

									<?php if (isset($breadcrumb['icon'])) { ?>
										<span class='heroicon text-base-content mr-2 w-4 h-4 heroicon-<?= $active_link_icon ?>'></span>
									<?php } else { ?>
										<svg class='mr-2 w-4 h-4 text-base-content' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>
											<path d='M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z'></path>
										</svg>
									<?php } ?>
								<?php } else if (count($breadcrumbs) - 1 >= $index) { ?>
									<svg class='w-6 h-6 text-base-content' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>
										<path fill-rule='evenodd' d='M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z' clip-rule='evenodd'></path>
									</svg>
								<?php } ?>
								<?= $breadcrumb['label'] ?>
							</a>
						</li>
					<?php } ?>
				</ol>
			</nav>
			<nav class='flex py-3 px-5'>
				<ol class='inline-flex items-center space-x-1 md:space-x-3'>
					<?php foreach ($actions as $index => $action) { ?>
						<li class='inline-flex items-center'>
							<a href='<?= $action['url'] ?>' class='btn <?= $action['class'] ?> font-bold py-2 px-4 rounded inline-flex items-center text-center'>
								<?php if (isset($action['icon'])) { ?>
									<div class='mr-2 -ml-1 w-4 h-4'>
										<span class='heroicon heroicon-<?= $action['icon'] ?>'></span>
									</div>
								<?php } ?>
								<?= $action['label'] ?>
							</a>
						</li>
					<?php } ?>
				</ol>
			</nav>
		</div>
	</div>
<?php } ?>

<div class='fixed top-0 right-0 mt-2 z-50 alert-wrapper'>
	<?php foreach (Yii::$app->session->getAllFlashes() as $class => $content) { ?>
		<?php
		$path = '';
		$label = '';
		$buttons = [];

		if (is_array($content)) {
			$label = $content['label'] ?? '';
			$buttons = $content['buttons'] ?? [];
		}
		if (is_string($content)) {
			$label = $content;
		}

		switch ($class) {
			case 'info': {
					$path = 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
				}
				break;
			case 'success': {
					$path = 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z';
				}
				break;
			case 'warning': {
					$path = 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z';
				}
				break;
			case 'error': {
					$path = 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z';
				}
				break;
		}
		?>

		<script>
			setTimeout(() => {
				addAlert('<?= $class ?>', '<?= $label ?>', <?= json_encode($buttons) ?>, 30000);
			}, 1);
		</script>
	<?php } ?>
</div>
