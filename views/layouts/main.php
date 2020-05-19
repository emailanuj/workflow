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
// use yii\bootstrap\Modal;

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
            <aside class="main-sidebar">
                <section class="sidebar">
                     <?= $this->render('sidebar-menu') ?>
                </section>
                <!--<section class="version"><p>Version 4.0</p></section>-->
            </aside>

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
    
    <?php
        yii\bootstrap\Modal::begin([
            'options' => [
                'tabindex' => false // important for Select2 to work properly
            ],
            'header'=>'<h4 class="modal-title" id="modalHeader"></h4>',
            'footer'=>'
                <button type="button" class="btn btn-success save-ajax-btn" >Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            ',
            'id' => 'modal',
            //'size' => 'modal-lg',
            //keeps from closing modal with esc key or by clicking out of the modal.
            // user must click cancel or X to close
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],

        ]);
        echo "<div class='batch-info'></div>
             <div id='modalContent'></div>";
        yii\bootstrap\Modal::end();
    ?>


    <script type="text/javascript">
        $(document).ready(function(){
            //Table Filter
            $("#TableSearch").click(function(){
                $(".table-filter").toggle();
            });

            // $('#modal').modal('show');
        });
    </script>
</body>
</html>
<?php $this->endPage() ?>
