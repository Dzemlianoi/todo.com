<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegForm extends Model{
    public $login;
    public $password;
    public $email;

    public function rules(){
        return[
            [['login','email','password'], 'required'],
            [['login','email','password'],'filter','filter'=>'trim'],
            ['login','string','min'=>'2','max'=>'42'],
            ['password','string','min'=>'6','max'=>'32'],
            ['login','unique','targetClass'=>Users::className(),'message'=>'This username isnt unique'],
            ['email','unique','targetClass'=>Users::className(),'message'=>'This email isnt unique'],
            ['email','email'],
        ];
    }
    public function reg(){
        return true;
    }


}