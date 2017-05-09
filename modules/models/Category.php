<?php

namespace app\modules\models;

use function array_key_exists;
use function array_merge;
use function current;
use const false;
use function key;
use function next;
use function str_repeat;
use function time;
use const true;
use function var_dump;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "shop_category".
 *
 * @property integer $cateid
 * @property string $title
 * @property integer $parentid
 * @property integer $createtime
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required','message' =>'分类名称不能为空'],
	        [['title'], 'unique','message' =>'分类名称已存在'],
            [['parentid', 'createtime'], 'integer'],
            [['title'], 'string', 'max' => 32],
            [['createtime'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cateid' => 'ID',
            'title' => '分类名称',
            'parentid' => '上级分类',
            'createtime' => '创建时间',
        ];
    }

    //将数据写入数据库
    public function add($data)
    {
    	$data['Category']['createtime'] = time();
    	//载入数据并且保存入数据库 则返回真 否则返回假
    	if ($this->load($data) &&  $this->save()) {
    		return true;
	    }
	    return false;
    }

    //查询处所有数据
    public function getData()
    {
    	$cates = self::find()->all();
    	 // var_dump($cates);
    	$cates = ArrayHelper::toArray($cates);
	    //  var_dump($cates);
    	return $cates;
    }

    //获取树状数据
	public function getTree($cates, $pid = 0)
	{
		$tree = [];
		foreach ($cates as $cate){
			if ($cate['parentid'] == $pid) {
				$tree[] =$cate;
				$tree = array_merge($tree, $this->getTree($cates, $cate['cateid']));
			}
		}

		return $tree;
	}

	public function setPrefix($data, $p = "|----")
	{
		$tree = [];
		$num = 1;
		$prefix = [0 => 1];

		while ($val = current($data)) {
			$key = key($data);
			if ($key > 0) {
				if ($data[$key -1 ]['parentid'] != $val['parentid']) {
					$num ++;
				}
			}

			if (array_key_exists($val['parentid'], $prefix)) {
				$num = $prefix[$val['parentid']];
			}

			$val['title'] = str_repeat($p, $num).$val['title'];
			$prefix[$val['parentid']] = $num;
			$tree[] = $val;
			next($data);
		}
		return $tree;
	}

	public function getOptions()
	{
		$data = $this->getData();
		$tree = $this->getTree($data);
		$tree = $this->setPrefix($tree);

		$options = ['添加顶级分类'];
		foreach ($tree as $cate) {
			$options[$cate['cateid']] = $cate['title'];
		}

		return $options;


	}

	public function getTreeList()
	{
		$data = $this->getData();
		$tree = $this->getTree($data);
		return $tree = $this->setPrefix($tree);
	}



}
