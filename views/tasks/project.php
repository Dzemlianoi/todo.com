<div class="project" id="<?= $model['id']?>">
    <div class="head-project bg-primary">
        <span class="glyph-for-head-projects glyphicon glyphicon-tasks"></span>
        <span class="project-name">Task list №<?= $model['id']?></span>
        <div class="head-buttons-div">
            <span onclick="deleteProject(<?=$model['id']?>)" class="glyph-for-head-projects glyphicon glyphicon-pencil"></span>
            <span class="glyph-for-head-projects glyphicon glyphicon-trash"></span>
        </div>
    </div>
    <div class="head-add-bar">
        <span class="glyph-for-head-projects glyphicon glyphicon-plus"></span>
        <input type="text" placeholder="Put a name of your task">
        <button class="btn btn-success">Add a task</button>
    </div>
    <div class="tasks-of-project empty-project">
        No current tasks
    </div>
</div>