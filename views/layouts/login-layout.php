<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LoginAsset;
use yii\helpers\Url;

LoginAsset::register($this);
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

<body class="gray-bg">
    <?php $this->beginBody() ?>
    <div class="loginColumns animated fadeInDown">
        <?= $content ?>
        <?php $this->endBody() ?>
        <script type="text/javascript">
            $(document).ready(function() {
                //Table Filter
                $("#TableSearch").click(function() {
                    $(".table-filter").toggle();
                });
            });
        </script>
</body>

</html>
<?php $this->endPage() ?>