<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/7
 * Time: 下午3:33
 */
namespace app\modules\controllers;

use app\modules\models\Admin;
use const false;
use function session_start;
use function var_dump;
use Yii;
use yii\web\Controller;

class PublicController extends Controller
{
	public function actionLogin()
	{
		$this->layout = false;
		$model = new Admin();

		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			//调用模型类Admin中的login方法 来实现
			// 需要设置形参  传递实参
			if ($model->login($post)) {
				$this->redirect(['default/index']);
				Yii::$app->end();
			}

		}
		return $this->render('login', ['model' => $model]);
	}

	public function actionLogout()
	{
		Yii::$app->session->removeAll();

		if (!isset(Yii::$app->session['admin']['isLogin'])) {
			$this->redirect(['public/login']);
			Yii::$app->end();
		}

		$this->goBack();
	}

	/**
	 * 找回密码
	 */
	public function actionSeekpasswd()
	{
		$this->layout = false;
		$model = new Admin();
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			/*
			 *  在Admin 模型里增加一个找回密码的方法
			 * 这个方法有一个形参
			 */
			if ($model->seekPass($post)) {
				Yii::$app->session->setFlash('info','电子邮件发送成功，请注意查收！');
			}

		}


		return $this->render("seekpasswd" ,['model' => $model]);
	}

}