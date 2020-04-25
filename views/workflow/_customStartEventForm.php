<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TblKeywords;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $workflowStartEventModel app\models\WorkflowStartEventModel */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
$keyword=TblKeywords::find()->all();
$keywordsList=ArrayHelper::map($keyword,'keyword_name','keyword_name');
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
          
          <?= $form->field($workflowStartEventModel, 'step_no')->textInput(['autofocus' => true,'id'=>'step_no','name'=>'step_no']) ?>
          <?= $form->field($workflowStartEventModel, 'if_fail')->dropDownList(['0' => 'Please Select', 'stop' => 'Stop','continue'=>'Continue'],['id'=>'if_fail','name'=>'if_fail']) ?>
          <?= $form->field($workflowStartEventModel, 'next_process')->textInput(['id'=>'next_process','name'=>'next_process']) ?>
          <?= $form->field($workflowStartEventModel, 'keywords')->dropDownList($keywordsList,['prompt'=>'Please select Keyword','id'=>'keywords','name'=>'keywords']) ?>
          <?= $form->field($workflowStartEventModel, 'api_url')->textInput(['id'=>'api_url','name'=>'api_url']) ?>
		  

          <div class="form-group">
              <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'savestartevent' ]) ?>
              <button id="SEClose" type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
          </div>
      </div>
  </div>
  </div>
  <?php ActiveForm::end(); ?>
  <!-- </form> -->