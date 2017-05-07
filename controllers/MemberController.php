<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/7
 * Time: 下午2:09
 */
namespace app\controllers;

use const false;
use yii\web\Controller;

class MemberController extends Controller
{


	public function actionAuth()
	{
		$this->layout = 'layout2';
		return $this->render('auth');
	}
}