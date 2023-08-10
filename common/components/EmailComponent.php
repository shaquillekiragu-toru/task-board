<?php

namespace common\components;

use yii\base\Component;

class EmailComponent extends Component {

	public function getCompanyEmails($email) {
		$email_split = explode('@', $email);

		$options = [
			$email_split[0] . '@toru.digital',
			$email_split[0] . '@toruinteractive.com',
			$email_split[0] . '@toruinteractive.co.uk',
		];

		if (!in_array($email, $options)) {
			return [];
		}

		return $options;
	}
}
