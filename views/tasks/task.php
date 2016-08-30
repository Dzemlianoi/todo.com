<?php
use yii\jui\DatePicker;
?>

<?php
    if ($task['done']==1){
        $checked='checked';
        $class_row='task-completed';
        $class_input='task-text-completed';
    }
    $deadline=isset($task['deadline'])?$task['deadline']:Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
?>
<div class="task-row <?=$class_row?>" id="task<?=$task['id']?>" data="<?=$task['priority']?>">
    <div class="done-task">
        <input <?=$checked?> type="checkbox"/>
    </div>
    <div class="text-task">
        <input type="text" maxlength="40" class="<?=$class_input?> input-name-task" disabled value="<?=$task['text']?>"/>
    </div>
    <div class="task-deadline">
        <?= DatePicker::widget([
            'attribute' => 'from_date',
            'language' => 'en',
            'value'=>$deadline,
            'dateFormat' => 'yyyy-MM-dd',
        ]); ?>
    </div>
    <div class="task-updating none-display">
        <div class="task-order-change">
            <span class="glyphicon glyphicon-chevron-up"></span>
            <span class="glyphicon glyphicon-chevron-down"></span>
        </div>
        <span class="glyphicon glyphicon-pencil"></span>
        <span class="glyphicon glyphicon-trash"></span>
    </div>
</div>
<div class="clear-both" id="clearboth"></div>