<?php

namespace app\models;

use Yii;
use yii\mongodb\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * Sphere model
 *
 * @property BSON $_id
 * @property string $name
 * @property string $email
 * @property string $phone
 */

class EntryForm extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return 'bot';
    }

    public function attributes()
    {
        return [
            '_id',
            'name',
            'email',
            'phone'
        ];
    }
    public $_id;
    public $name;
    public $email;
    public $phone;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone'], 'required'],
            ['name', 'trim'],
            ['name', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['phone', 'integer', 'min' => 7],
            [['_id',], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['_id' => $id]);
    }
}
