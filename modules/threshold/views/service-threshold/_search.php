<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceThresholdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-threshold-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'service_type') ?>

    <?= $form->field($model, 'tags') ?>

    <?= $form->field($model, 'threshold_for_peak_in_last_15days') ?>

    <?= $form->field($model, 'threshold_for_current_utilisation') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
