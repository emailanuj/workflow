<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TblKeywords;
use yii\helpers\ArrayHelper;
use app\models\TblFunctions;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $WorkflowDataModel app\models\WorkflowDataModel */
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
<div id="properties">
          <div id="close">
              <img src="<?= Url::base() .'/images/pop-close.png'?>">
          </div>
          <p id="title-properties">Set Field Parameters</p>
          <div id="proplist">
    <div class="container-fluid">
            <div class="panel-body">
            <?= $form->field($WorkflowDataModel, 'step_no')->textInput(['autofocus' => true,'placeholder'=>'Step No', 'type' => 'number']) ?>

            <?= $form->field($WorkflowDataModel, 'if_fail')->dropDownList(['stop' => 'Stop','continue'=>'Continue'],['prompt'=>'Please Select']) ?>

            <?= $form->field($WorkflowDataModel, 'next_process')->textInput(['placeholder'=>'Next Process', 'type' => 'number']) ?>

            <?= $form->field($WorkflowDataModel, 'keywords')->dropDownList($keywordsList,['prompt'=>'Please select Keyword']) ?>
		<div class="api_cls" style="display:none;">
            <?= $form->field($WorkflowDataModel, 'api_url')->textInput(['placeholder'=>'API URL']) ?>

            <?= $form->field($WorkflowDataModel, 'api_method')->dropDownList(['get' => 'Get','post'=>'Post'],['prompt'=>'Please Select']) ?>
            
            <div class="api_post_field" style="display:none;"><?= $form->field($WorkflowDataModel, 'api_post_params')->textInput() ?></div>
           
            <?= $form->field($WorkflowDataModel, 'api_type')->dropDownList(['rest' => 'Rest'/*,'soap'=>'Soap'*/],['prompt'=>'Please Select']) ?>

            <?= $form->field($WorkflowDataModel, 'api_headers')->textInput(['placeholder'=>'API Headers']) ?>

            <?= $form->field($WorkflowDataModel, 'function_execute')->dropDownList($functions_exe_list,['prompt'=>'Please select Function']) ?>
            
            <?= $form->field($WorkflowDataModel, 'auth_type')->dropDownList([/*'login' => 'Login','both'=>'Both',*/'token'=>'Token'],['prompt'=>'Please Select']) ?>
            
            <?= $form->field($WorkflowDataModel, 'token_from')->dropDownList(['token_url'=>'Token URL'],['prompt'=>'Please Select']) ?>
            
            <?= $form->field($WorkflowDataModel, 'token_url')->textInput(['placeholder'=>'Token URL']) ?>
            
            <?= $form->field($WorkflowDataModel, 'username')->textInput(['placeholder'=>'Username']) ?>
            
            <?= $form->field($WorkflowDataModel, 'password')->textInput(['placeholder'=>'Password']) ?>
 		</div>
 		<div class="ds_cls" style="display:none;">
 		<?= $form->field($WorkflowDataModel, 'data_source')->dropDownList(['function_name' => 'Function Name','form_data'=>'Form Data','begnning_data'=>'Data at Begnning','prev_process'=>'From Previous Process'],['prompt'=>'Please Select']) ?>
 		</div>
 		<div class="func_cls" style="display:none;">
 		    <?= $form->field($WorkflowDataModel, 'get_data_function')->dropDownList($functions_get_data_list,['prompt'=>'Please select Function']) ?>
 		</div>
 		<div class="formdata_cls" style="display:none;">
 		    <?= $form->field($WorkflowDataModel, 'form_data')->textarea(['placeholder'=>'Form Data']) ?>
 		</div>
 		<input type="hidden" name="element_id" value="<?php echo $element_id;?>">
 		<input type="hidden" name="element_type" value="<?php echo $element_type;?>">
 		<input type="hidden" name="workflow_id" value="<?php echo $workflow_id;?>">
 		<input type="hidden" name="form_json_data" id="form_json_data" value="">
         <input type="hidden" name="saved_form_data" id="saved_form_data" value="">
            <div class="form-group">
              <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'savestartevent' ]) ?>
                <button id="SEClose" type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
      </div>
      </div>
     </div>
<?php ActiveForm::end(); ?>