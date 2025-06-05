<?php

namespace www\controllers;

class SiteController extends \TiCMS\controllers\WebController
{

	public function actionIndex()
	{
		return $this->redirect(['task/index']);
	}

	public function actionTest()
	{
		return $this->render('test');
	}
}
