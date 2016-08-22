<?php

namespace app\controllers;

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

    public function actionSignin()
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

}
