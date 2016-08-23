<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

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
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password;
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

    public function behaviors(){
        return[

            TimestampBehavior::className()

        ];
    }

    public function setPassword($password){
        $this->password=Yii::$app->security->generatePasswordHash($password);
    }
    public function validatePassword($password){
        return Yii::$app->security->validatePassword($password,$this->password);
    }

    public function generateAuthKey(){
        $this->auth_key=Yii::$app->security->generateRandomString();
    }

//    User identification

    public static function findIdentity($id)
    {
        return static::findOne(['id'=>$id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findIdentityByLogin($login){

        return static::findOne(['login'=>$login]);

    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Projects::className(), ['user_id' => 'id']);
    }
}
