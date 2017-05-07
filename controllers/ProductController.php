<?php
namespace app\controllers;
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/7
 * Time: 下午1:15
 */

use const false;
use yii\web\Controller;

/**
 * Class ProductController
 * @package app\controllers
 */
class ProductController extends Controller
{
	public function actionIndex()
	{
		$this->layout = 'layout2';
		return $this->render('index');
	}

	public function actionDetail()
	{
		$this->layout = 'layout2';
		return $this->render('detail');
	}
}