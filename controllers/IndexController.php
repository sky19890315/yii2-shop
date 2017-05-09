<?php
namespace app\controllers;

use const false;
use Yii;
use yii\web\Controller;
use app\models\Testuser;

/**
 * Class IndexController
 * @package app\controllers
 */
class IndexController extends Controller
{
	public function  actionIndex()
	{

	$model = new Testuser();
	$data = $model->find()->one();
    $this->layout = 'layout1';
	   return $this->render('index', array("row" => $data));	
        }	
} 
