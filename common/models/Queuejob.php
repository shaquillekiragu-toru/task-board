<?php

namespace common\models;

use yii;
use yii\web\HttpException;

class Queuejob extends \common\models\RestModel {

	public const IMPORT_STATUS_RUNNING = 0;
	public const IMPORT_STATUS_ERROR = -1;
	public const IMPORT_STATUS_COMPLETE = 1;

	/** @inheritdoc */
	public static function tableName() {
		return 'queue_job';
	}

	public function rules() {
		return array_merge(
			parent::rules(),
			[
				[[], 'required'],
				[['parent_id', 'output', 'job_count'], 'safe']
			]
		);
	}

	public function getChildren() {
		return $this->hasMany(Queuejob::class, ['parent_id' => 'id']);
	}

	public function makeNewJob($model, $params) {
		$uid = uniqid();
		$params['job_id'] = $uid;
		$model = new $model($params);
		$job = new Queuejob();
		$job->title = $uid;
		if (!$job->save()) {
			throw new HttpException(404, 'Error creating job');
		}
		Yii::$app->queue->push($model);
		return $uid;
	}
}
