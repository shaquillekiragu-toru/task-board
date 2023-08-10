<?php

namespace api\behaviours;

class ApiBehaviour extends \yii\base\Behavior {

	public function fields() {
		return [
			'id',
		];
	}

	public function extraFields() {
		return [
			'title',
			'active',
			'createdBy',
			'updatedBy',
		];
	}
}
