<?php

namespace app\controllers;

use Yii;
use app\models\RegForm;
use app\models\LoginForm;
use app\models\Users;

class AuthController extends \yii\web\Controller
{
    public function actionIndex()
    {

    }

    public function actionSignin(){
        $model=new LoginForm();
        if ($model->load(Yii::$app->request->post())&&$model->signin()){
            return $this->goHome();
        }
        return $this->render(
            'signin',
            ['model'=>$model]
        );
    }

    public function actionRegistration(){

        $model=new RegForm();
        if ($model->load(Yii::$app->request->post())&&$model->validate()){
            if ($user=$model->reg()){
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }else{
                Yii::$app->session->setFlash('message','Something goes wrong, try again later');
                Yii::error('Registration error'.'<pre>'.Yii::$app->request->post().'</pre>');
                return $this->actionRegistration();
            }
        }
        return $this->render(
            'registration',
            ['model'=>$model]
            );
    }

}
