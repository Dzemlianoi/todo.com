<?php

namespace app\controllers;

use Yii;
use app\models\RegForm;
use app\models\LoginForm;

class AuthController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (!empty ($_SESSION['user'])) {
            $link = 'http://' . $_SERVER['HTTP_HOST'] . '/auth/exit';
            $text='Sign out';
            $glyph='glyphicon-log-out';
        }else{
            $link = 'http://' . $_SERVER['HTTP_HOST'] . '/auth';
            $text='Sign in';
            $glyph='glyphicon-log-in';
        }
        return $this->render('index',
            [
                'link'=>$link,
                'text'=>$text,
                'glyph'=>$glyph
            ]);
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
            if ($model->reg()){
                return $this->goHome();
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
