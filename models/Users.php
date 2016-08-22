<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $email
 * @property string $auth_key
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Projects[] $projects
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login','password','email'],'filter','filter'=>'trim'],
            [['login', 'email'], 'required'],
            [['login'], 'string','min'=>2, 'max' => 40],
            ['password','required','on'=>'create'],
            ['email', 'email'],
            [['login'], 'unique','message'=>'Login isnt unique'],
            [['email'], 'unique','message'=>'Email isnt unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Projects::className(), ['user_id' => 'id']);
    }
}
