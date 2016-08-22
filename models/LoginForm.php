<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model{
    public $login;
    public $password;
    public $email;
    public $rememberMe=1;

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

    public function validatePassword($attribute){

    }

    public function attributeLabels()
    {
        return[

            'rememberMe'=>'Remember me'

        ];
    }

    public function signin(){
        return true;
    }
}