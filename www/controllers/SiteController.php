<?php

namespace www\controllers;

class SiteController extends \TiCMS\controllers\WebController
{

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionTest()
	{
		return $this->render('test');
	}
}
