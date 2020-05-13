<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
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
<body class="skin-blue">
    <?php $this->beginBody() ?>
    <div id="PopoverBackdrop" class="pop-backdrop"></div>
    <div class="custom-loader"></div>
    <div class="wrapper">
        <!-- Header Starts -->
        <header class="main-header">
            <a class="logo" href="<?= Yii::$app->homeUrl ?>">
                <img src="<?= Url::base() .'/images/logo-cisco.png' ?>">
            </a>
            
        </header>
        <div class="alert-wrap error_display_div" style="display:none;">
                <div class="alert alert-danger alert-dismissible ">
                    <div class="error_display"></div>
                </div>
            </div>
            <div class="alert-wrap success_display_div" style="display:none;">
                <div class="alert alert-success alert-dismissible ">
                    <div class="error_display"></div>
                </div>
            </div>
            <div class="preloader" style="display:none;">
                <div class="loader-container">
                    <div class="loader-img"><img src="<?= Url::base() .'/images/loading.gif' ?>" alt="preloader"><p class="preloader_message"></p></div>
                </div>
            </div>
            <div class="content-wrapper">
                <section class="content">
                    <div>
                        
                        <div class="title-breadcrumb">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="page-title-div">
                                            <h3 class="page-title">
                                                <!-- <span><img src="public/images/icons/title-workflow-execution.png"> </span>Workflow Execution -->
                                                <?= Breadcrumbs::widget([
                                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                                ]) ?>
                                                <?= Alert::widget() ?>
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6 absoluteClm">
                                        <div class="page-action-wrapper text-right">
                                            <span class="table-search-icon">
                                                <button class="btn-transparent btn-search" id="TableSearch"><img src="public/images/search-icon.png"></button>
                                            </span>                                           
                                            <button class="btn btn-update">Create Workflow</button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="row">
                                <?= $content ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class='control-sidebar-bg'></div>
    </div>

    <?php $this->endBody() ?>
    <script type="text/javascript">
            $(document).ready(function(){
                //Table Filter
                $("#TableSearch").click(function(){
                    $(".table-filter").toggle();
                });
            });
        </script>
</body>
</html>
<?php $this->endPage() ?>
