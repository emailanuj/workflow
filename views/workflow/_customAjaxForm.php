<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $workflowDataModel app\models\Workflow */
/* @var $form yii\widgets\ActiveForm */
?>
  <!-- <form id="seModal0" action="" name="seModal0"> -->
  <?php $form = ActiveForm::begin([
    'id' => 'seModal0',
    //'action'  => 'user-default-shipping/create',
    'options' => [
      'onsubmit' => 'return false'
  ]
  ]); ?>
   <div class="panel panel-default" id="formgroup">
    <div class="panel-heading" role="tab" id="heading0">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" aria-controls="collapse0">
          Event Configuration
        </a>
      </h4>
    </div>
    <div id="collapse0" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading0">
      <div class="panel-body">
          
          <?= $form->field($workflowDataModel, 'step_no')->textInput(['autofocus' => true]) ?>

          <?= $form->field($workflowDataModel, 'if_fail') ?>

          <?= $form->field($workflowDataModel, 'next_process') ?>


          <div class="form-group">
              <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'customcheck' ]) ?>
          </div>
      </div>
  </div>
  </div>
  <?php ActiveForm::end(); ?>
  <!-- </form> -->