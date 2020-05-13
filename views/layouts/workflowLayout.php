<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\WorkFlowAsset;
use yii\helpers\Url;

WorkFlowAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <script type="text/javascript">
        var baseURL = "<?= \yii\helpers\Url::base(true) ?>";
    </script>

</head>
<body>
<?php $this->beginBody() ?>
 <div class="wrapper" style="min-height: 100%; height: auto;">
    <header class="main-header">
            <a class="logo" href="<?= Yii::$app->homeUrl ?>">
                <img src="<?= Url::base() .'/images/logo-cisco.png' ?>">
            </a>
            
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="javascript:void(0)" class="dropdown-toggle clearfix" data-toggle="dropdown">
                                    <div class="user-icon pull-left">
                                        <img src="<?= Url::base() .'/images/user-icon.png' ?>" class="user-image" alt="User Image"/>
                                    </div>
                                    <!-- --------- ------------------ Check for Login ------------------->
                                    <?php if(Yii::$app->user->isGuest){?>
                                    <div class="pull-left"><a href="<?= Url::to(['site/login']) ?>">Login</a></div>
                                    <?php }else {?>
                                    <div class="pull-left"><?= Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        'Logout (' .  Yii::$app->user->identity->username . ')',
                                        ['class' => 'btn btn-link logout']
                                    )
                                    . Html::endForm();?>
                					</div>
               					    <?php }?>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
