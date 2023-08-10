<?php

namespace admin\controllers;

use TiCMS\controllers\WebController;
use yii;
use yii\filters\AccessControl;
use admin\models\Email;
use Spipu\Html2Pdf\Html2Pdf;

/**
 * Email Controller.
 */
class EmailController extends WebController {
	public $modelClass = 'admin\models\Email';

	/* @inheritdoc */
	public function behaviors(): array {
		Yii::$app->response->headers->set('x-frame-options', 'SAMEORIGIN');

		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => [
							'index',
							'view',
							'create',
							'update',
							'delete',
							'render',
							'preview',
							'static'
						],
						'allow' => true,
						'roles' => ['admin']
					],
					[
						'actions' => ['*'],
						'allow' => false
					],
				],
			]
		];
	}

	public function actionRender($slug) {
		$path = '@emails';
		$json_path = $path . "/${slug}.json";

		return $this->render('render', [
			'slug' => $slug,
			'json' => json_decode(file_get_contents(Yii::getAlias($json_path)))
		]);
	}

	public function actionStatic(string $slug): string {
		$model = new Email();
		$model->template = "@emails/${slug}.php";

		$model->params = file_get_contents(Yii::getAlias("@emails/${slug}.json"));

		$html2pdf = new Html2Pdf('P', 'A4', 'en', false, 'UTF-8');
		$html2pdf->writeHTML($model->renderEmail());
		$html2pdf->output();
		return '';
	}

	public function actionPreview(string $slug): string {
		$model = new Email();
		$model->template = "@emails/${slug}.php";

		$default_params = json_decode(file_get_contents(Yii::getAlias("@emails/${slug}.json")));
		$raw_params = Yii::$app->request->get('json', '{}');
		$params = json_decode($raw_params);
		$model->params = json_encode(array_merge((array) $default_params, (array) $params));
		return $model->renderEmail();
	}
}
