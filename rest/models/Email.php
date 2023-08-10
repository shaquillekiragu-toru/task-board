<?php

namespace rest\models;

use yii;

class Email extends \common\models\Email {

	/* @inheritdoc */
	public function getTitle(): string {
		return '';
	}

	public function tiSearch(array $params) {
		$files = scandir(Yii::getAlias('@emails'));
		$files = array_filter($files, function ($file) {
			return $file[0] != '.' && strpos($file, 'php') !== false;
		});
		$files = array_values($files);

		return array_map(function ($file) {
			$slug = substr($file, 0, strpos($file, '.'));
			$title = ucwords(str_replace('-', ' ', $slug));
			return [
				'id' => $slug,
				'title' => $title,
				'active' => 1,
				'liveedit' => [
					'buttons' => [[
						'label' => 'edit',
						'class' => 'btn-primary',
						'url' => '/email/render/' . $slug
					], [
						'label' => 'done',
						'class' => 'btn-default',
						'url' => '#close'
					]],
					'subTitle' => Yii::getAlias('@emails/' . $file),
					'icon' => false,
					'radius' => '50%',
					'status' => [],
					'summary' => [],
					'title' => $title
				],
				'thumbnail' => false
			];
		}, $files);
	}
}
