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
    <div id="wrapper">
    <?php //echo $this->render('sidebar-menu')  ?>
        <div class="preloader" style="display:none;">
            <div class="loader-container">
                <div class="loader-img"><img src="<?= Url::base() . '/images/loading.gif' ?>" alt="preloader">
                    <p class="preloader_message"></p>
                </div>
            </div>
        </div>

        <div id="page-wrapper" class="gray-bg" style="width:100%;">
            <?php //echo $this->render('top-menu')  ?>
            <div class="container-fluid">
                <?= $content ?>
            </div>
            <div class="footer">
                <div>
                    <strong>Copyright</strong> CISCO &copy; 2020
                </div>
            </div>
        </div>
        <div id="right-sidebar">
        </div>

    </div>
    <?php $this->endBody() ?>

    <?php
    yii\bootstrap\Modal::begin([
        'options' => [
            'tabindex' => false, // important for Select2 to work properly
            'class' => 'inmodal'
        ],
        'header' => '<h4 class="modal-title" id="modalHeader"></h4>',
        'footer' => '
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
        $(document).ready(function() {
            //Table Filter
            $("#TableSearch").click(function() {
                $(".table-filter").toggle();
            });

            // $('#modal').modal('show');
        });
    </script>
</body>

</html>
<?php $this->endPage() ?>