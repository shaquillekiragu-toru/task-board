<?php

namespace rest\models;

class User extends \common\models\User
{

	/* @inheritdoc */
	public function getTitle(): string
	{
		return $this->full_name ?? '';
	}

	/* @inheritdoc */
	public function getSubtitle(): string
	{
		return $this->email ?? '';
	}

	/* @inheritdoc */
	public function getLiveedit(): array
	{
		return array_merge(
			parent::getLiveedit(),
			[
				'title' => $this->getTitle()
			]
		);
	}

	/* @inheritdoc */
	public function getButtons(): array
	{
		return [
			[
				"label" => "Edit",
				"class" => "btn-primary",
				"url" => '/user/view/' . $this->id
			],
			[
				"label" => "Done",
				"class" => "btn-ghost",
				"url" => "#close"
			],
		];
	}

	public function makeFilters()
	{
		return array_merge(parent::makeFilters(), [
			[
				'label' => 'Active',
				'key' => 'a',
				'type' => 'select',
				'empty' => 'Active/Inactive',
				'options' => [
					[
						'label' => 'Active',
						'value' => 1,
					],
					[
						'label' => 'Inactive',
						'value' => 0,
					]
				]
			],
		]);
	}

	/* @inheritdoc */
	public function getStatus(): array
	{
		$status = [];

		$status[] = [
			"label" => $this->_role,
			"class" => "label"
		];

		if (!$this->active) {
			$status[] = [
				"label" => 'Inactive',
				"class" => "info"
			];
		}

		return $status;
	}
}
