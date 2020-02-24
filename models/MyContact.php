<?php

namespace app\models;

use Yii;
use yii\base\Model;

class MyContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message'], 'required'],
            ['email', 'email'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 50],
            [['message'], 'string', 'max' => 255],

        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'message' => 'Message',
        ];
    }
}
