<?php


namespace app\controllers;

use app\models\Users;
use app\models\Projects;
use app\models\Tasks;
use Yii;

class TasksController extends \yii\web\Controller
{
    const DEFAULT_PROJECT_NAME='Task List';

    public function actionIndex()
    {
        $id=Yii::$app->user->getId();
        $projects=Projects::find()->where(['user_id'=>$id])->orderBy('id')->all();
        return $this->render('index',['data'=>$projects]);
    }

    public function actionCreateproject(){

        $model=new Projects();

        $model->user_id=Yii::$app->user->getId();
        $model->name=self::DEFAULT_PROJECT_NAME;

        if ($model->save()){
            echo ($this->renderAjax('project',['model'=>$model]));
        }
    }

    public function actionDeleteproject(){
        $id = $_GET['id'];
        $project = Projects::findOne($id);
        return $project->delete();
    }

    public function actionUpdateproject(){
        $id=$_GET['id'];
        $name=$_GET['value'];
        $project=Projects::findOne($id);
        $project->name=$name;
        return $project->save();

    }

    public function actionCreatetask(){

        $project_id=$_GET['id'];
        $name=$_GET['text'];
        $task=new Tasks();
        $task->text=$name;
        $last_order=Tasks::find()->where(['project_id'=>$project_id])->orderBy(['priority' => SORT_DESC])->one();
        $task->priority=is_int($last_order['priority'])?$last_order['priority']+1:1;
        $task->done=0;
        $task->project_id=$project_id;

        if ($task->save()) {
            echo ($this->renderAjax('task',['model'=>$task]));
        }
    }

    public function actionDeletetask(){
        $task_id = $_GET['id'];
        $task = Tasks::findOne($task_id);
        return $task->delete();
    }
}
