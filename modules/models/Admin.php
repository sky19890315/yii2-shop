<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/5/7
 * Time: 下午3:57
 */
namespace app\modules\models;

use const false;
use function ip2long;
use function is_null;
use function session_set_cookie_params;
use function time;
use const true;
use function var_dump;
use Yii;
use yii\db\ActiveRecord;

class Admin extends ActiveRecord
{

	public $repass = null;
	public $rememberMe = true;

	public static function tableName()
	{
		return "{{%shop_admin}}";
	}

	/*
	 * 数据验证
	 */
	public function rules()
	{
		return [
			['adminuser' ,'required', 'message' => '管理员账号不能为空' ,'on' => ['login', 'seekpass', 'adminadd','changeemail']],
			['adminuser' ,'unique', 'message' => '管理员账号已经存在' ,'on' => ['seekpass', 'adminadd']],
			['adminpasswd' ,'required', 'message' => '管理员密码不能为空', 'on' => ['login','adminadd','changeemail','changepass']] ,
			['rememberMe', 'boolean', 'on' => 'login'],
			['adminpasswd', 'validatePass' , 'on'   => ['login','changeemail']],
			['adminemail' ,'required', 'message' => '管理员邮箱不能为空', 'on' => ['seekpass','adminadd','changeemail']],
			['adminemail' ,'email', 'message' => '管理员邮箱格式不正确' ,'on' => ['seekpass','adminadd','changeemail']],
			['adminemail' ,'unique', 'message' => '邮箱已经被注册' ,'on' => ['adminadd','changeemail']],
			['adminemail', 'validateEmail','on' => 'seekpass'],
			['repass', 'required', 'message' => '密码不能为空', 'on' => ['adminadd','changepass']],
			['repass', 'compare','compareAttribute' => 'adminpasswd', 'message' => "密码不一致" ,'on' => ['adminadd','changepass']],

		];
	}

	/*
	 * 如果没有错误 就去数据库查找 查找到内容 就返回对比
	 * 否则就是用户名或者密码错误
	 */
	public function validatePass()
	{
		if (!$this->hasErrors()) {
			$data = self::find()->where('adminuser = :user and adminpasswd = :passwd', [":user" => $this->adminuser,
				":passwd" => $this->adminpasswd
				])->one();
			if (is_null($data)) {
				$this->addError("adminpasswd", "用户名或者密码错误");
			}

		}
	}

	public function validateEmail()
	{
		if (!$this->hasErrors()) {
			$data = self::find()->where('adminuser =:user and adminemail = :email', [
				":user" => $this->adminuser, ":email" => $this->adminemail
			])->one();

			if (is_null($data)) {
				$this->addError("adminemail", "管理员账号或者邮箱错误");
			}

		}


	}

	public function login($data)
	{
		$this->scenario = "login";

		if ($this->load($data) && $this->validate()) {
			$lifetime = $this->rememberMe ? 24*3600 : 0;
			$session = Yii::$app->session;
			session_set_cookie_params($lifetime);
			//登录成功后把信息存入session
			$session['admin'] = [
				'adminuser' =>  $this->adminuser,
				'isLogin'  => 1,
			];
			//更新数据库中表的字段
			$this->updateAll(['logintime' => time(), 'loginip' =>ip2long(Yii::$app->request->userIP)],
				'adminuser = :user', [':user' => $this->adminuser]);

			return (bool)$session['admin']['isLogin'];
		}

		return false;

	}

	public function seekPass($data)
	{
		$this->scenario = "seekpass";
		if ($this->load($data)  && $this->validate()) {
			//发送邮件
			$mailer = Yii::$app->mailer->compose();
			$mailer->setFrom('laravelsky@163.com');
			$mailer->setTo($data['Admin']['adminemail']);
			$mailer->setSubject("sky找回密码");

			if ($mailer->send()) {
				return true;
			}

		}
		return false;
	}

	public function reg($data)
	{
		$this->scenario = 'adminadd';
		if ($this->load($data) && $this->save()) {
			return true;
		} else {
			return false;
		}
	}


	public function changeEmail($data)
	{
		$this->scenario = 'changeemail';
		if ($this->load($data) && $this->save()) {
			return (bool)$this->updateAll(['adminemail' => $this->adminemail], 'adminuser = :user', [':user' => $this->adminuser]);
		}
		return false;

	}

	public function changePass($data)
	{
		$this->scenario = 'changepass';
		if ($this->load($data) && $this->save()) {
			return (bool)$this->updateAll(['adminpasswd' => $this->adminpasswd], 'adminuser = :user', [':user' => $this->adminuser]);
		}
		return false;
	}




}