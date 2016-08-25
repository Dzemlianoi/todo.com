<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegForm extends Model{
    public $login;
    public $password;
    public $email;
    public $confirmPassword;

    public function rules(){
        return[
            [['login','email','password','confirmPassword'], 'required'],
            [['login','email','password'],'filter','filter'=>'trim'],
            ['login','string','min'=>'2','max'=>'42'],
            [['password','confirmPassword'],'string','min'=>'6','max'=>'32'],
            ['login','unique','targetClass'=>Users::className(),'message'=>'This username isnt unique'],
            ['email','unique','targetClass'=>Users::className(),'message'=>'This email isnt unique'],
            ['email','email'],
        ];
    }
    public function attributeLabels()
    {
       return [
          'confirmPassword'=>'Confirm password'
        ];
    }

    public function reg(){
        $user = new Users();
        $user->login=$this->login;
        $user->email=$this->email;
        $user->generateAuthKey();
        $user->setPassword($this->password);
        if ($this->checkConfirmation()){
            return $user->save()?$user:NULL;
        }
    }

    public function checkConfirmation(){

        return $this->password==$this->confirmPassword;

    }
}