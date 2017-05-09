<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/7
 * Time: 下午6:34
 */
namespace app\modules\controllers;

use app\modules\models\Admin;
use function var_dump;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;

class ManagerController extends Controller
{
	public function actionManagers()
	{
		$this->layout = 'layout1';
		$model = Admin::find();

		$count = $model->count();

		$pagerSize = Yii::$app->params['pageSize']['manage'];

		$pager = new Pagination(['totalCount' => $count, 'pageSize' => $pagerSize]);
		$managers = $model->offset($pager->offset)->limit($pager->limit)->all();

		return $this->render('managers', ['managers' => $managers, 'pager' => $pager]);
	}

	public function actionReg()
	{
		$this->layout = "layout1";

		$model = new Admin();
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			/*
			 * 调用Admin里面的reg方法  并带有形参
			 */
			if ($model->reg($post)){
				Yii::$app->session->setFlash('info', '添加成功！');
			} else {
				Yii::$app->session->setFlash('info','添加失败！');
			}

		}

		return $this->render('reg', ['model' => $model]);
	}




	public function actionDel()
	{
		$adminid = (int)Yii::$app->request->get('adminid');
		if (empty($adminid)) {
			Yii::$app->session->setFlash('info', '删除失败！');
			return $this->redirect(['manager/managers']);
		}

		$model = new Admin();

		if ($model->deleteAll('adminid = :id', [':id' => $adminid])) {
			Yii::$app->session->setFlash('info', '删除成功！');
			return $this->redirect(['manager/managers']);
		}
	}

	public function actionChangeemail()
	{
		$this->layout = "layout1";
		$model = Admin::find()->where('adminuser = :user', [':user' => Yii::$app->session['admin']['adminuser']])->one();
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			if ($model->changeemail($post)) {
				Yii::$app->session->setFlash('info', '邮箱修改成功！');
			}
		}

			$model->adminpasswd = "";
		return $this->render('changeemail', ['model' => $model]);

	}


	public function actionChangepass()
	{
		$this->layout = 'layout1';
		$model = Admin::find()->where('adminuser = :user', [':user' => Yii::$app->session['admin']['adminuser']])->one();

		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			if ($model->changepass($post)) {
				Yii::$app->session->setFlash('info', '密码修改成功！');
			}
		}
		$model->adminpasswd = "";
		return $this->render('changepass', ['model' => $model]);
	}


}