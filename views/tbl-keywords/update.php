<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblKeywords */

$this->title = 'Update Tbl Keywords: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Keywords', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-keywords-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
