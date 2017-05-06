<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Testuser;

class IndexController extends Controller
{
	public function  actionIndex()
	{
	$model = new Testuser();
	$data = $model->find()->one();
           
  
	   return $this->render('index', array("row" => $data));	
        }	
} 
