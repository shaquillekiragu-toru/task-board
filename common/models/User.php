<?php

namespace common\models;

class User extends \TiCMS\models\User {

	const ROLE_BLOCKED = 0;
	const ROLE_USER = 1;
	const ROLE_CLIENT = 2;
	const ROLE_STAFF = 3;
	const ROLE_ADMIN = 4;
	const ROLE_SUPERADMIN = 5;

	public $_roles = [
		self::ROLE_BLOCKED => 'Blocked',
		self::ROLE_USER => 'User',
		self::ROLE_CLIENT => 'Client',
		self::ROLE_STAFF => 'Staff',
		self::ROLE_ADMIN => 'Admin',
		self::ROLE_SUPERADMIN => 'SuperAdmin'
	];

	public $order_by = [
		'created_at' => SORT_DESC,
		'email' => SORT_ASC,
	];

	public function rules() {
		return array_merge(
			parent::rules(),
			[
				[
					[
						'reminder_submit_timings',
						'organisation_id',
						'visible_to_clients',
						'reset_password_on_signin',
						'is_developer',
						'user_group_id'
					],
					'integer'
				],
				[
					['slack_name'],
					'string'
				],
				[
					['billable_multiplier'],
					'safe'
				]
			]
		);
	}

	public function beforeValidate() {
		$this->title = $this->email;

		return parent::beforeValidate();
	}

	public function attributeLabels() {
		return array_merge(
			parent::rules(),
			[
				'reminder_submit_timings' => 'Timings submission reminders',
				'slack_name' => 'Slack Display Name',
				'organisation_id' => 'Organisation',
				'visible_to_clients' => 'Show in TI Team Section',
				'reset_password_on_signin' => 'Require Password Reset on Next Login',
				'is_developer' => 'Is Developer?',
				'user_group_id' => 'User Group',
			]
		);
	}

	public function beforeSave($insert) {
		if ($this->isNewRecord) {
			$this->access_token = \Yii::$app->security->generateRandomString();
			$this->country_id = Country::find()->where(['two_digit_code' => 'GB'])->one()->id;
		}

		return parent::beforeSave($insert);
	}

	public function afterSave($insert, $changedAttributes) {
		if (array_key_exists('role', $changedAttributes)) {
			$auth = \Yii::$app->authManager;
			$auth->revokeAll($this->id);
			$newRole = $auth->getRole(strtolower($this->_role));
			$auth->assign($newRole, $this->id);
		}

		return parent::afterSave($insert, $changedAttributes);
	}

	public static function getSearchFilterKey(): string {
		$parts = explode('\\', self::className());
		return strtolower(array_pop($parts));
	}

	public function getSearchFilterValue(): string {
		return self::getSearchFilterKey() . ":{$this->id}∆";
	}

	public function getSearchFields(): array {
		$search = "{$this->full_name}∆{$this->email}";
		if ($this->organisation) {
			$search .= "∆" . $this->organisation->title;
		}
		$filters = "a:{$this->active}∆";
		$filters .= Organisation::getSearchFilterKey() . ":{$this->organisation_id}∆";
		$filters .= "r:{$this->role}∆";
		$filters .= "v:{$this->visible_to_clients}∆";
		$filters .= "d:{$this->is_developer}∆";

		return [
			'search' => $search,
			'filters' => $filters
		];
	}

	public static function findIdentityByAccessToken($token, $type = null) {
		$api_token = Apitoken::findOne(['token' => $token, 'expire_date' => null]);
		if ($api_token != null) {
			if ($api_token->user != null) {
				return $api_token->user;
			}
		}

		$api_token = Apitoken::findOne([
			'AND',
			['token' => $token],
			['>', 'expire_date', time()],
		]);
		if ($api_token != null) {
			if ($api_token->user != null) {
				return $api_token->user;
			}
		}

		return static::findOne(['access_token' => $token, 'status' => self::STATUS_ACTIVE]);
	}

	public function clearAuthVars() {
		$this->access_token = null;
		$this->access_token_expiry = null;
	}
}
