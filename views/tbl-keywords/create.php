<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblKeywords */

$this->title = 'Create Tbl Keywords';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Keywords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-keywords-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
