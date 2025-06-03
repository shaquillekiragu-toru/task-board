<?php

namespace common\models;

class User extends \TiCMS\models\User
{

	const ROLE_BLOCKED = 0;
	const ROLE_USER = 1;
	const ROLE_ADMIN = 2;
	const ROLE_SUPERADMIN = 3;

	public $_roles = [
		self::ROLE_BLOCKED => 'Blocked',
		self::ROLE_USER => 'User',
		self::ROLE_ADMIN => 'Admin',
		self::ROLE_SUPERADMIN => 'SuperAdmin'
	];

	public $order_by = [
		'created_at' => SORT_DESC,
		'email' => SORT_ASC,
	];

	public function beforeValidate()
	{
		$this->title = $this->email;

		return parent::beforeValidate();
	}

	public function beforeSave($insert)
	{
		if ($this->isNewRecord) {
			$this->access_token = \Yii::$app->security->generateRandomString();
			$this->country_id = Country::find()->where(['two_digit_code' => 'GB'])->one()->id;
			$this->setPassword($this->password);
		}

		return parent::beforeSave($insert);
	}

	public function afterSave($insert, $changedAttributes)
	{
		if (array_key_exists('role', $changedAttributes)) {
			$auth = \Yii::$app->authManager;
			$auth->revokeAll($this->id);
			$newRole = $auth->getRole(strtolower($this->_role));
			$auth->assign($newRole, $this->id);
		}

		return parent::afterSave($insert, $changedAttributes);
	}

	public static function getSearchFilterKey(): string
	{
		$parts = explode('\\', self::className());
		return strtolower(array_pop($parts));
	}

	public function getSearchFilterValue(): string
	{
		return self::getSearchFilterKey() . ":{$this->id}∆";
	}

	public function getSearchFields(): array
	{
		$search = "{$this->full_name}∆{$this->email}";
		$filters = "a:{$this->active}∆";
		$filters .= "r:{$this->role}∆";

		return [
			'search' => $search,
			'filters' => $filters
		];
	}

	public static function findIdentityByAccessToken($token, $type = null)
	{
		return static::findOne(['access_token' => $token, 'status' => self::STATUS_ACTIVE]);
	}

	public function clearAuthVars()
	{
		$this->access_token = null;
		$this->access_token_expiry = null;
	}
}
