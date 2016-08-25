<div class="project" id="<?= $project['id']?>">
    <div class="head-project bg-primary">
        <span class="glyph-for-head-projects glyphicon glyphicon-tasks"></span>
        <input disabled type="text" value="<?= $project['name']?>" class="project-name"/>
        <div class="head-buttons-div">
            <span class="glyph-for-head-projects glyphicon glyphicon-pencil"></span>
            <span class="glyph-for-head-projects glyphicon glyphicon-trash"></span>
        </div>
    </div>
    <div class="head-add-bar">
        <span class="glyph-for-head-projects glyphicon glyphicon-plus"></span>
        <input type="text" placeholder="Put a name of your task">
        <button class="task-add-btn btn btn-success">Add a task</button>
    </div>
    <div class="tasks-of-project empty-project">
        <?foreach ($project['tasks'] as $task){
          echo $this->render('task',['task'=>$task]);
        }
        ?>
    </div>
</div>