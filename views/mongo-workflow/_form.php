<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MongoWorkFlow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mongo-work-flow-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'workflow_title') ?>

    <?= $form->field($model, 'workflow_description') ?>

    <?= $form->field($model, 'workflow_data') ?>

    <?= $form->field($model, 'workflow_json') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
