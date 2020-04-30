<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $workflowDataModel app\models\Workflow */
/* @var $form yii\widgets\ActiveForm */
?>
  <!-- <form id="seModal0" action="" name="seModal0"> -->
  <?php $form = ActiveForm::begin([
    'id' => 'workflow_save',
    'action'  => 'workflow/create',
  ]); ?>
   <form id="w0" action="" method="post">
        <div class="modal-header">
        <center><h4>Save Workflow</h4></center>
        </div>
        <div class="modal-body">
          <div class="form-group">
          <?= $form->field($workflowModel, 'workflow_title')->textInput(['autofocus' => true,'placeholder'=>'Workflow Title','required'=>'required']) ?>
          </div>
          <div class="form-group">
          <?= $form->field($workflowModel, 'workflow_description')->textarea(['placeholder'=>'Workflow Description']) ?>
          </div>
        </div>
        <div class="modal-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'savestartevent','onClick'=>'clearLocalStorage()' ]) ?>
        </div>
      </div>
      </form>
  <?php ActiveForm::end(); ?>
  <!-- </form> -->