<?php

namespace rest\controllers;

class UserController extends \TiCMS\controllers\RestController {

	public $modelClass = 'rest\models\User';
	public $hosts = [ADMIN];
}
