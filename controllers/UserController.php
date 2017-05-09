<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/9
 * Time: 上午8:47
 */
namespace app\controllers;

use app\models\Shopuser;
use yii\web\Controller;

class UserController extends Controller
{
	public $layout = 'layout1';
	public function actionReg()
	{

		$model = new Shopuser();
		return $this->render('reg', ['model' => $model]);
	}
}