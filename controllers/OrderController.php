<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/7
 * Time: 下午1:56
 */
namespace app\controllers;

use const false;
use yii\web\Controller;

class OrderController extends Controller
{
	//public $layouts = false;

	public function actionIndex()
	{
		//调用类的属性 可以解决定义其属性解决
		$this->layout = 'layout2';
		return $this->render('index');
	}


	public function actionCheck()
	{
		 $this->layout = 'layout1';
		return $this->render('check');
	}
}