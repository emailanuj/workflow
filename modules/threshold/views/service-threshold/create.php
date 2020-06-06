<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceThreshold */

$this->title = 'Create Service Threshold';
$this->params['breadcrumbs'][] = ['label' => 'Service Thresholds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-threshold-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
