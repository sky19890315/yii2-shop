<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/7
 * Time: 下午1:33
 */
namespace app\controllers;

use const false;
use yii\web\Controller;

class CartController extends Controller
{
	public function actionIndex()
	{
		$this->layout = 'layout1';
		return $this->render('index');
	}
}

