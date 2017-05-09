<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/8
 * Time: 上午1:30
 */
namespace app\modules\controllers;

use yii\web\Controller;

class OrderController extends Controller
{
	public $layout = 'layout1';

	public function actionList()
	{
		return $this->render('list');
	}

	public function actionDetail()
	{
		return $this->render('detail');
	}

	public function actionSend()
	{
		return $this->render('send');
	}

}