<div class="task-row" id="task<?=$model['id']?>">
    <div class="done-task">
        <input type="checkbox"/>
    </div>
    <div class="text-task">
        <input type="text" class="input-name-task" disabled value="<?=$model['text']?>"/>
    </div>
    <div class="task-updating">
        <div class="task-order-change">
            <span class="glyphicon glyphicon-chevron-up"></span>
            <span class="glyphicon glyphicon-chevron-down"></span>
        </div>
        <span class="glyphicon glyphicon-pencil"></span>
        <span class="glyphicon glyphicon-trash"></span>
    </div>
</div>