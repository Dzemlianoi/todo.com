<?php


namespace app\controllers;

use app\models\Users;
use app\models\Projects;
//use app\models\Tasks;
use Yii;

class TasksController extends \yii\web\Controller
{
    const DEFAULT_PROJECT_NAME='Task List';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate(){

        $model=new Projects();

        $model->user_id=Yii::$app->user->getId();
        $model->name=self::DEFAULT_PROJECT_NAME;

        if ($model->save()){

            echo ($this->renderAjax('project',['model'=>$model]));
        }else{

            echo $model->user_id;
        }
    }

    public function actionDelete(){
        $id=$_GET['id'];

        $model=new Projects();
        $project=$model::findOne($id);
        if ($project->delete()){
            echo 'deleted';
        }
    }

    public function actionUpdate(){
        $id=$_GET['id'];
        $name=$_GET['value'];
        $project=Projects::findOne($id);
        $project->name=$name;
        if ($project->save()){
            echo 'lol';
        }else{
            echo'not lol';
        }
    }






}
