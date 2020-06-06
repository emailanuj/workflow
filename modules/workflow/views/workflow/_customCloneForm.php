<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Workflow */
/* @var $form yii\widgets\ActiveForm */
$clones = array('structure'=>'Structure','data'=>'Structure & Data');
?>

<div class="clone-form">
    <?php $form = ActiveForm::begin([
        'id' => 'formclone',
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
    ]); ?>

    <?= $form->field($clonemodel,'clone_title')->textInput(['maxlength' => true]); ?>
    <?= $form->field($clonemodel,'clone_description')->textInput(['maxlength' => true]); ?>
    <?= $form->field($clonemodel,'clone_type')->dropDownList($clones,['prompt'=> 'select Clone Type']);   ?>
    <?= Html::activeHiddenInput($clonemodel,'clone_id'); ?>
    <?php ActiveForm::end(); ?>
</div>
