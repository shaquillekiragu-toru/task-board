<?php

namespace common\models;

use yii\web\HttpException;

class Sitesetting extends \common\models\RestModel {

	const CRON_SEND_EMAILS = 'Cron Send Emails';

	/* @inheritdoc */
	public static function tableName() {
		return 'site_setting';
	}

	/* @inheritdoc */
	public function rules() {
		return [
			[['title'], 'required'],
			[['title'], 'unique'],
			[['title', 'value', 'active'], 'safe'],
		];
	}

	public static function findByTitleAndCreateIfMissingWithDefault($title, $default) {
		$slug = preg_replace('~[^\\pL\d]+~u', '-', $title);
		$slug = trim($slug, '-');
		$slug = iconv('utf-8', 'ASCII//IGNORE//TRANSLIT', $slug);
		$slug = strtolower($slug);
		$slug = preg_replace('~[^-\w]+~', '', $slug);

		$model = self::find()->where(['slug' => $slug])->one();

		if (!$model) {
			$model = new Sitesetting();
			$model->title = $title;
			$model->slug = $slug;
			$model->value = $default;

			if (!$model->save()) {
				throw new HttpException(404, "Cannot create site setting");
			}
		}

		return $model;
	}
}
