<div class="form-box">
    <span class="simple-text">Simple ToDo list from</span>
    <span class="simple-complany-name">Ruby Garage</span>
    <span class="simple-try"></span>
    <?php
    if (Yii::$app->user->isGuest){
        $buttons='
       <a href="/web/index.php?r=auth%2Fsignin"><button class="btn btn-default">Sign in</button></a>
       <a href="/web/index.php?r=auth%2Fregistration"><button class="btn btn-success">Registry</button></a>';
    }else{
        $buttons='
       <a href="/web/index.php?r=tasks%2Findex"><button class="btn btn-primary">Tasks</button></a>';
    }
    echo $buttons;

    ?>
</div>