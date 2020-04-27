<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WorkflowTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workflow-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'workflow_template_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'workflow_template_description')->textInput(['maxlength' => true]) ?>    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
