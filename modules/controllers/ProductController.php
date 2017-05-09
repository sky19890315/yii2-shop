<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/8
 * Time: 上午1:23
 */
namespace app\modules\controllers;

use yii\web\Controller;

class ProductController extends Controller
{
	public $layout = 'layout1';

	public function actionProducts()
	{
		return $this->render('products');
	}


	public function actionAdd()
	{
		return $this->render('add');
	}
}