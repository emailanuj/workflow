<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $workflowDataModel app\models\Workflow */
/* @var $form yii\widgets\ActiveForm */
?>
  <?php $form = ActiveForm::begin([
    'id' => 'workflow_save',
    'enableClientValidation' => true,
    'enableAjaxValidation' => false,
    // 'options' => [
    //     'validateOnSubmit' => false,
    // ],
  ]); ?>
        <div class="form-group">
            <?= $form->field($workflowModel, 'workflow_title')->textInput(['autofocus' => true,'placeholder'=>'Workflow Title']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($workflowModel, 'workflow_description')->textarea(['placeholder'=>'Workflow Description']) ?>
        </div>
        
        <!-- <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'savestartevent','onClick'=>'clearLocalStorage()' ]) ?>
            <?= Html::button('Cancel', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'create-workflow' ]) ?>
        </div> -->

  <?php ActiveForm::end(); ?>