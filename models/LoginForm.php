<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\User;

class LoginForm extends Model{
    public $login;
    public $password;
    public $email;
    public $rememberMe=1;
    private $_user=false;

    public function rules(){
        return
            [
                [['login','password'], 'required','on'=>'default'],
                ['login','string','min'=>'2','max'=>'40'],
                ['password','string','min'=>'2','max'=>'40'],
                ['email','email'],
                ['rememberMe','boolean'],
                ['password','validatePassword']

            ];
    }
    public function getUser(){
        if ($this->_user===false){
            $this->_user=Users::findIdentityByLogin($this->login);
        }
        return $this->_user;
    }
    public function validatePassword($attribute){
        $user=$this->getUser();
        if (!$user){
            $this->addError($attribute,'Such login doesnt exist');
        }else if(!$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Wrong password');
        }else{
            return true;
        }


    }

    public function attributeLabels()
    {
        return[

            'rememberMe'=>'Remember me'

        ];
    }

    public function signin(){

        $user=$this->getUser();

        return $this->validate()?Yii::$app->user->login($user,$this->rememberMe?3600*24*30:0):false;

    }
}