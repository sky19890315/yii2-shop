<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/8
 * Time: 上午1:07
 */
namespace app\modules\controllers;

use yii\web\Controller;

class UserController extends Controller
{
	public $layout = 'layout1';

	public function actionUsers()
	{
		return $this->render('users');
	}

	public function actionReg()
	{
		return $this->render('reg');
	}

}