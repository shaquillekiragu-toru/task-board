<?php

namespace api\models;

class User extends \common\models\User {

	public function behaviors() {
		return array_merge(
			parent::behaviors(),
			[
				"Api_behaviour" => "\\api\\behaviours\\ApiBehaviour"
			]
		);
	}

	public function fields() {
		$fields = [];
		foreach ($this->behaviors as $behaviour) {
			if (str_starts_with(get_class($behaviour), 'api\\')) {
				try {
					$new_fields = $behaviour->fields();

					$fields = array_merge($fields, $new_fields);
				}
				catch (\Exception $ex) {
				}
			}
		}

		return $fields;
	}

	public function extraFields() {
		$fields = [];
		foreach ($this->behaviors as $behaviour) {
			if (str_starts_with(get_class($behaviour), 'api\\')) {
				try {
					$new_fields = $behaviour->extraFields();

					$fields = array_merge($fields, $new_fields);
				}
				catch (\Exception $ex) {
				}
			}
		}

		return $fields;
	}
}
