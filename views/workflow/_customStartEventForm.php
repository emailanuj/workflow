<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TblKeywords;
use yii\helpers\ArrayHelper;
use app\models\TblFunctions;
/* @var $this yii\web\View */
/* @var $workflowStartEventModel app\models\WorkflowStartEventModel */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
$keyword=TblKeywords::find()->orderBy(['keyword_name'=>SORT_ASC])->all();
$keywordsList=ArrayHelper::map($keyword,'keyword_name','keyword_name');
$functions_exe=TblFunctions::find()->where(['function_type'=>'EXECUTABLE'])->orderBy(['function_name'=>SORT_ASC])->all();
$functions_exe_list=ArrayHelper::map($functions_exe,'function_name','function_name');
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
          <?= $form->field($workflowStartEventModel, 'if_fail')->dropDownList(['stop' => 'Stop','continue'=>'Continue'],['prompt'=>'Please Select','id'=>'if_fail','name'=>'if_fail']) ?>
          <?= $form->field($workflowStartEventModel, 'next_process')->textInput(['id'=>'next_process','name'=>'next_process']) ?>
          <?= $form->field($workflowStartEventModel, 'keywords')->dropDownList($keywordsList,['prompt'=>'Please select Keyword','id'=>'keywords','name'=>'keywords']) ?>
          <?= $form->field($workflowStartEventModel, 'api_url')->textInput(['id'=>'api_url','name'=>'api_url']) ?>
		  <?= $form->field($workflowStartEventModel, 'api_method')->dropDownList(['get' => 'Get','post'=>'Post'],['prompt'=>'Please Select','id'=>'api_method','name'=>'api_method']) ?>
		  <?= $form->field($workflowStartEventModel, 'api_type')->dropDownList(['rest' => 'Rest','soap'=>'Soap'],['prompt'=>'Please Select','id'=>'api_type','name'=>'api_type']) ?>
		  <?= $form->field($workflowStartEventModel, 'api_headers')->textInput(['id'=>'api_headers','name'=>'api_headers']) ?>
		  <?= $form->field($workflowStartEventModel, 'function_execute')->dropDownList($functions_exe_list,['prompt'=>'Please select Function','id'=>'function_execute','name'=>'function_execute']) ?>
		  <?= $form->field($workflowStartEventModel, 'auth_type')->dropDownList(['login' => 'Login','token'=>'Token','both'=>'Both'],['prompt'=>'Please Select','id'=>'auth_type','name'=>'auth_type']) ?>
		  <?= $form->field($workflowStartEventModel, 'token_from')->dropDownList(['prev_response' => 'Previous Response','token_url'=>'Token URL'],['prompt'=>'Please Select','id'=>'token_from','name'=>'token_from']) ?>
		  <?= $form->field($workflowStartEventModel, 'token_url')->textInput(['id'=>'token_url','name'=>'token_url']) ?>
		  <?= $form->field($workflowStartEventModel, 'username')->textInput(['id'=>'username','name'=>'username']) ?>
		  <?= $form->field($workflowStartEventModel, 'password')->textInput(['id'=>'password','name'=>'password']) ?>
          <div class="form-group">
              <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'savestartevent' ]) ?>
              <button id="SEClose" type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
          </div>
      </div>
  </div>
  </div>
  <?php ActiveForm::end(); ?>
  <!-- </form> -->