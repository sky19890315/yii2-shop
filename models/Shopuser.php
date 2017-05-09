<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_user".
 *
 * @property integer $userid
 * @property string $username
 * @property string $userpasswd
 * @property string $useremail
 * @property integer $createtime
 *
 * @property ShopProfile $shopProfile
 */
class Shopuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'userpasswd', 'useremail'], 'required'],
            [['createtime'], 'integer'],
            [['username', 'userpasswd'], 'string', 'max' => 32],
            [['useremail'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'username' => 'Username',
            'userpasswd' => 'Userpasswd',
            'useremail' => 'Useremail',
            'createtime' => 'Createtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopProfile()
    {
        return $this->hasOne(ShopProfile::className(), ['userid' => 'userid']);
    }
}
