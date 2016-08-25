<?php
/* @var $this yii\web\View */
?>
<div class="task-lists-div">
    <?foreach ($data as $project){
        echo $this->render('project',['project'=>$project]);
    };
    ?>
</div>
<button class="btn btn-primary button-add-project" >
    <span class="glyphicon glyphicon-plus"></span> Add Task List
</button>
