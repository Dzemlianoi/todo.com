<?php

namespace app\controllers;

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
        $result=[];
        foreach($projects as $project){
            $result[$project['id']]['name']=$project['name'];
            $result[$project['id']]['tasks']=$this->getTasksOfProject($project['id']);
            $result[$project['id']]['id']=$project['id'];
        }

        return $this->render('index',['data'=>$result]);
    }

    public function getTasksOfProject($project_id){
       return $tasks=Tasks::find()->where(['project_id'=>$project_id])->orderBy('priority')->all();
    }

    public function actionCreateproject(){
        $model=new Projects();

        $model->user_id=Yii::$app->user->getId();
        $model->name=self::DEFAULT_PROJECT_NAME;

        echo $model->save()?$this->renderAjax('project',['project'=>$model]):NULL;
    }

    public function actionDeleteproject(){
        $id = $_GET['id'];
        $project = Projects::findOne($id);
        echo $project->delete()?'deleted':NULL;
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
        $date=date('d.m.y');

        $task=new Tasks();
        $task->text=$name;
        $last_order=Tasks::find()->where(['project_id'=>$project_id])->orderBy(['priority' => SORT_DESC])->one();
        $task->priority=is_int($last_order['priority'])?$last_order['priority']+1:1;
        $task->done=0;
        $task->project_id=$project_id;
        $task->deadline=Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');

        echo $task->save()?$this->renderAjax('task',['task'=>$task]):NULL;
    }

    public function actionDeletetask(){
        $task_id = $_GET['id'];
        $task = Tasks::findOne($task_id);
        echo $task->delete()?'deleted':NULL;
    }

    public function actionUpdatetask(){
        $id=$_GET['id'];
        $name=$_GET['value'];
        $task=Tasks::findOne($id);
        $task->text=$name;
        return $task->save();
    }

    public function actionUpdatestatus(){
        $id=$_GET['id'];
        $checked=$_GET['checked'];
        $task=Tasks::findOne($id);
        $task->done=$checked=='true'?1:0;
        return $task->save();
    }

    public function actionChangeorder(){
        $first_id=$_GET['id1'];
        $second_id=$_GET['id2'];

        $first_task=Tasks::findOne($first_id);
        $second_task=Tasks::findOne($second_id);

        $temp=$first_task->priority;
        $first_task->priority=$second_task->priority;
        $second_task->priority=$temp;

        return ($first_task->save()&&$second_task->save());
    }
}
