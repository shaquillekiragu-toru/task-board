<?php

namespace rest\models;

class Import extends \common\models\Import {

	/* @inheritdoc */
	public function getStatus(): array {
		$status = [];

		$status[] = [
			'label' => $this->statusLabel,
			'class' => $this->statusColour,
		];

		return $status;
	}

	public function makeFilters() {
		$statuses = [
			[
				'value' => self::IMPORT_STATUS_AWAITING_USER_SIGNOFF,
				'label' => $this->getStatusLabel(self::IMPORT_STATUS_AWAITING_USER_SIGNOFF),
			],
			[
				'value' => self::IMPORT_STATUS_AWAITING_RESEARCH_SIGNOFF,
				'label' => $this->getStatusLabel(self::IMPORT_STATUS_AWAITING_RESEARCH_SIGNOFF),
			],
			[
				'value' => self::IMPORT_STATUS_AWAITING_BATCH_SIGNOFF,
				'label' => $this->getStatusLabel(self::IMPORT_STATUS_AWAITING_BATCH_SIGNOFF),
			],
			[
				'value' => self::IMPORT_STATUS_SIGNED_OFF,
				'label' => $this->getStatusLabel(self::IMPORT_STATUS_SIGNED_OFF),
			],
		];

		$start = new \DateTime();
		$start->setTimestamp(Import::find()->select('MIN(first_date)')->scalar());
		$start->modify('first day of this month');
		$end = new \DateTime();
		$end->modify('first day of this month');
		$interval = \DateInterval::createFromDateString('1 month');
		$period = new \DatePeriod($start, $interval, $end);
		$month_range = [];

		foreach ($period as $dt) {
			$month_range[] = [
				'value' => $dt->format("Ym"),
				'label' => $dt->format("F Y"),
			];
		}
		$month_range = array_reverse($month_range);

		return [
			[
				'key' => 'status',
				'label' => 'Status',
				'empty' => 'Any Status',
				'default' => self::IMPORT_STATUS_SIGNED_OFF,
				'type' => 'select',
				'options' => $statuses
			],
			[
				'key' => User::getSearchFilterKey(),
				'label' => 'User',
				'empty' => 'Any User',
				'type' => 'select',
				'options' => User::find()
					->select([
						'id AS value',
						'CONCAT(first_name, " ", last_name) AS label',
					])
					->orderBy([
						'CONCAT(first_name, " ", last_name)' => SORT_ASC
					])
					->asArray()
					->all()
			],
			[
				'key' => 'ym',
				'label' => 'Month',
				'empty' => 'Any Month',
				'type' => 'select',
				'options' => $month_range,
			],
		];
	}

	public function get_thumbnail() {
		return $this->user->profilePicture;
	}
}
