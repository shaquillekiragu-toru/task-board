<?php

namespace common\models;

class RestModel extends \TiCMS\models\RestModel {

	public $order_by = [
		'created_at' => SORT_DESC,
		'title' => SORT_ASC,
	];

	public function getTitle(): string {
		return $this->title ?? '';
	}

	public static function getSearchFilterKey(): string {
		$parts = explode('\\', self::className());
		return strtolower(array_pop($parts));
	}

	public static function getOptionsForDropDown($value = 'id', $label = 'title', $grouper = null) {
		$query = self::find();
		$results = $query->orderBy('title')->all();

		if ($grouper != null) {
			$new_results = [];

			for ($index = 0; $index < count($results); $index++) {
				if (!key_exists($results[$index]->$grouper, $new_results)) {
					$new_results[$results[$index]->$grouper] = [];
				}

				$new_results[$results[$index]->$grouper][$results[$index]->$value] = $results[$index]->$label;
			}

			return $new_results;
		}

		return array_column($results, 'title', 'id');
	}

	public function getSearchFilterValue(): string {
		return self::getSearchFilterKey() . ":{$this->id}∆";
	}

	public function getEditButtonLink() {
		$update = $this->update_link ?? '/' . strtolower($this->shortName) . '/view';

		if (strrpos($update, -1) != '/') {
			$update .= '/';
		}

		return $update . $this->id;
	}

	public function getButtons(): array {

		return [
			[
				"label" => "edit",
				"class" => "btn-ghost",
				"url" => $this->getEditButtonLink()
			],
			[
				"label" => "done",
				"class" => "btn-ghost",
				"url" => "#close"
			],
		];
	}

	public function getLiveedit(): array {
		return [
			"buttons" => $this->getButtons(),
			"subTitle" => $this->getSubtitle(),
			"icon" => $this->getIcon(),
			"radius" => $this->getRadius(),
			"status" => $this->getStatus(),
			"summary" => $this->getSummary(),
			"title" => $this->getTitle(),
		];
	}
}
