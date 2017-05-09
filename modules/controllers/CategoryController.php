<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/8
 * Time: 上午1:17
 */
namespace app\modules\controllers;

use app\modules\models\Category;
use function array_merge;
use const false;
use function var_dump;
use Yii;
use yii\web\Controller;

class CategoryController extends Controller
{
	public $layout = 'layout1';

	public function actionAdd()
	{
		$model = new Category();
		$list = $model->getOptions();
		// $list = array_merge([0 => '添加顶级分类'] , $list);
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			//如果添加成功
			//调用model里面的add方法 将数据下入数据库

			if ($model->add($post)) {
				Yii::$app->session->setFlash('info', '添加成功！');
				// return $this->goBack();
				return $this->redirect(['category/cates']);
			} else {
				Yii::$app->session->setFlash('info', '添加失败！');
				// return $this->goBack();
			}


		}
		return $this->render('add', ['list' => $list , 'model' => $model]);
	}

	public function actionCates()
	{
		$model = new Category();
		$cates = $model->getTreeList();
		return $this->render('cates', ['cates' => $cates]);
	}


	public function actionDel()
	{
		echo "这是删除界面";
	}


	public function actionMod()
	{
		$cateid = Yii::$app->request->get('cateid');
		//得到一个对象
		$model = Category::find()->where('cateid = :id', [':id' => $cateid])->one();
		$list = $model->getOptions();
		return $this->render('add', ['model' => $model ,'list' => $list]);
	}

}