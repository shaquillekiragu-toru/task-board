<?php

namespace www\controllers;

class SiteController extends \common\controllers\SiteController {

	/** @inheritdoc */
	public function behaviors() {
		return array_merge_recursive(parent::behaviors(), [
			'access' => [
				'rules' => [
					[
						'actions' => [
							'index',
							'search',
						],
						'allow' => true,
						'roles' => [
							'admin'
						]
					],
					[
						'actions' => [
							'*'
						],
						'allow' => false,
					]
				]
			]
		]);
	}
}
