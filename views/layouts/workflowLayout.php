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
                                <span class="hidden-xs">
                                    <div class="user-icon pull-left">
                                        <img src="<?= Url::base() .'/images/user-icon.png' ?>" class="user-image" alt="User Image"/>
                                    </div>
                                    <div class="welcome pull-left">Welcome,<span class="user-name">Admin</span></div>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="">
                                        <a href="javascript:void(0)" class="user-footer-links"><i class="fa fa-fw fa-user fa-lg"></i>My Profile</a>
                                    </div>
                                    <div class="">
                                        <a class="user-footer-links" href="javascript:void(0)" data-method="post">Sign Out</a>
                                    </div>
                                </li>
                            </ul>
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
