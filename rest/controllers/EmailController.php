<?php
namespace rest\controllers;

class EmailController extends \TiCMS\controllers\RestController {
	public $modelClass = 'rest\models\Email';
	public $hosts = [ADMIN];
}
