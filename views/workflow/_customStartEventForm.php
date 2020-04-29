<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TblKeywords;
use yii\helpers\ArrayHelper;
use app\models\TblFunctions;

/* @var $this yii\web\View */
/* @var $workflowStartEventModel app\models\WorkflowStartEventModel */
/* @var $form yii\widgets\ActiveForm */


$form = ActiveForm::begin([
    'id' => 'seModal0',
    //'action'  => 'user-default-shipping/create',
    'options' => [
        'onsubmit' => 'return false',
        'name' => 'workflow_form'
    ],
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
]);
?>
    <div class="panel panel-default" id="formgroup">
        <div class="panel-heading" role="tab" id="heading0">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" aria-controls="collapse0"> Event Configuration</a>
            </h4>
        </div>
        <div id="collapse0" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading0">
            <div class="panel-body">
            <?= $form->field($workflowStartEventModel, 'step_no')->textInput(['autofocus' => true,'placeholder'=>'Step No']) ?>

            <?= $form->field($workflowStartEventModel, 'if_fail')->dropDownList(['stop' => 'Stop','continue'=>'Continue'],['prompt'=>'Please Select']) ?>

            <?= $form->field($workflowStartEventModel, 'next_process')->textInput(['placeholder'=>'Next Process']) ?>

            <?= $form->field($workflowStartEventModel, 'keywords')->dropDownList($keywordsList,['prompt'=>'Please select Keyword']) ?>
		<div class="api_cls" style="display:none;">
            <?= $form->field($workflowStartEventModel, 'api_url')->textInput(['placeholder'=>'API URL']) ?>

            <?= $form->field($workflowStartEventModel, 'api_method')->dropDownList(['get' => 'Get','post'=>'Post'],['prompt'=>'Please Select']) ?>

            <?= $form->field($workflowStartEventModel, 'api_type')->dropDownList(['rest' => 'Rest','soap'=>'Soap'],['prompt'=>'Please Select']) ?>

            <?= $form->field($workflowStartEventModel, 'api_headers')->textInput(['placeholder'=>'API Headers']) ?>

            <?= $form->field($workflowStartEventModel, 'function_execute')->dropDownList($functions_exe_list,['prompt'=>'Please select Function']) ?>
            
            <?= $form->field($workflowStartEventModel, 'auth_type')->dropDownList(['login' => 'Login','token'=>'Token','both'=>'Both'],['prompt'=>'Please Select']) ?>
            
            <?= $form->field($workflowStartEventModel, 'token_from')->dropDownList(['prev_response' => 'Previous Response','token_url'=>'Token URL'],['prompt'=>'Please Select']) ?>
            
            <?= $form->field($workflowStartEventModel, 'token_url')->textInput(['placeholder'=>'Token URL']) ?>
            
            <?= $form->field($workflowStartEventModel, 'username')->textInput(['placeholder'=>'Username']) ?>
            
            <?= $form->field($workflowStartEventModel, 'password')->textInput(['placeholder'=>'Password']) ?>
 		</div>
 		<div class="ds_cls" style="display:none;">
 		<?= $form->field($workflowStartEventModel, 'data_source')->dropDownList(['function_name' => 'Function Name','form_data'=>'Form Data','begnning_data'=>'Data at Begnning','prev_process'=>'From Previous Process'],['prompt'=>'Please Select']) ?>
 		</div>
 		<div class="func_cls" style="display:none;">
 		    <?= $form->field($workflowStartEventModel, 'get_data_function')->dropDownList($functions_get_data_list,['prompt'=>'Please select Function']) ?>
 		</div>
 		<div class="formdata_cls" style="display:none;">
 		    <?= $form->field($workflowStartEventModel, 'form_data')->textarea(['placeholder'=>'Form Data']) ?>
 		</div>
            <div class="form-group">
              <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'savestartevent' ]) ?>
                <button id="SEClose" type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
      </div>
    </div>
<?php ActiveForm::end(); ?>