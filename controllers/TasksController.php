<?php


namespace app\controllers;

use app\models\Users;
use app\models\Projects;
//use app\models\Tasks;
use Yii;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate(){

        $model=new Projects();

        $model->user_id=Yii::$app->user->getId();
        $last_task=$model::find()->orderBy(['id' => SORT_DESC])->one();
        $new_user_id=$last_task['id']+1;
        $model->name='Task list №'.$new_user_id;

        if ($model->save()){
            $data['id']=$model->user_id;
            $data['name']=$model->name;

            echo ($this->renderAjax('project',['data'=>$data,'model'=>$model]));
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

    public function updateProject(){

    }






}
