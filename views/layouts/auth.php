<?php
use \app\assets\AppAsset;
use \yii\bootstrap\NavBar;
use \yii\bootstrap\Nav;

/*@var $content string
 *@var $this \yii\web\View */

AppAsset::register($this);
$this->beginPage();
?>

<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset?>"/>
    <?= $this->head() ?>
</head>
<body>
<?=$this->beginBody()?>
<div class="wrapper container admin-wrapper">
    <?php
    NavBar::begin(
        [
            'brandLabel' => 'Ruby garage ToDo',
            'options' => ['class'=>'custom-navbar']
        ]
    );

    echo Nav::widget([
        'items' => [
            [
                'label' => 'Register <span class="glyphicon glyphicon-lock"></span>',
                'url' => ['/auth/registration']
            ],
            [
                'label' => 'Sign in <span class="glyphicon glyphicon-log-in"></span>',
                'url' => ['/auth/signin']
            ],
            [
                'label' => 'About <span class="glyphicon glyphicon-question-sign"></span>',
                'url' => ['/auth/about']
            ],
            [
                'label' => 'Home <span class="glyphicon glyphicon-home"></span>',
                'url' => ['/auth/index']
            ]

        ],
        'encodeLabels'=>false,
        'options' => [
            'class' => 'navbar-nav navbar-right',
        ],
    ]);


    NavBar::end() ?>
<!--    Insert content-->
    <div class="container">
        <?=$content ?>
    </div>


</div>
<footer class="footer">
    <div class="container">
        <span class="badge">
            <span class="glyphicon glyphicon-copyright-mark"></span>Dzemlianoi<?=date('Y-M')?>
        </span>
    </div>
</footer>

<?=$this->endBody()?>
</body>
</html>
<?php
$this->endPage() ?>