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
    //'action'  => 'user-default-shipping/create',
    'options' => [
      'onsubmit' => 'return false'
  ]
  ]); ?>
   <form id="w0" action="" method="post">
        <div class="modal-header">
        <center><h4>Save Workflow</h4></center>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Workflow Title</label>
            <input type="text" id="workflow-workflow_title" class="form-control" name="Workflow[workflow_title]" maxlength="100" value="">
          </div>
          <div class="form-group">
            <label>Workflow Description</label>
            <input type="text" id="workflow-workflow_description" class="form-control" name="Workflow[workflow_description]" maxlength="200" value="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="SEClose">Cancel</button>
          <button type="submit" class="btn btn-default" onClick="clearLocalStorage()">Save</button>
        </div>
      </div>
      </form>
  <?php ActiveForm::end(); ?>
  <!-- </form> -->