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
    <!-- <div id="close">
        <img src="<?= Url::base() . '/images/pop-close.png' ?>">
    </div> -->
    <!-- <p id="title-properties">Set Field Parameters</p> -->
    <div id="proplist">
        <div class="container-fluid">
            <div class="panel-body">
                <!-- <?php //echo $form->field($WorkflowDataModel, 'title')->textInput(['autofocus' => true, 'placeholder' => 'Add Title']) 
                        ?> -->
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($WorkflowDataModel, 'step_no')->textInput(['autofocus' => true, 'placeholder' => 'Step No', 'type' => 'number']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($WorkflowDataModel, 'next_process')->textInput(['placeholder' => 'Next Process', 'type' => 'number']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($WorkflowDataModel, 'if_fail')->dropDownList(['stop' => 'Stop', 'continue' => 'Continue'], ['prompt' => 'Please Select']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($WorkflowDataModel, 'keywords')->dropDownList($keywordsList, ['prompt' => 'Please select Keyword']) ?>
                    </div>
                </div>

                <div class="api_cls" style="display:none;">
                    <?= $form->field($WorkflowDataModel, 'api_url')->textInput(['placeholder' => 'API URL']) ?>

                    <?= $form->field($WorkflowDataModel, 'api_method')->dropDownList(['get' => 'Get', 'post' => 'Post'], ['prompt' => 'Please Select']) ?>

                    <div class="api_post_field" style="display:none;"><?= $form->field($WorkflowDataModel, 'api_post_params')->textInput() ?></div>

                    <?= $form->field($WorkflowDataModel, 'api_type')->dropDownList(['rest' => 'Rest'/*,'soap'=>'Soap'*/], ['prompt' => 'Please Select']) ?>

                    <?= $form->field($WorkflowDataModel, 'api_headers')->textInput(['placeholder' => 'API Headers']) ?>

                    <?= $form->field($WorkflowDataModel, 'function_execute')->dropDownList($functions_exe_list, ['prompt' => 'Please select Function']) ?>

                    <?= $form->field($WorkflowDataModel, 'auth_type')->dropDownList([/*'login' => 'Login','both'=>'Both',*/'token' => 'Token'], ['prompt' => 'Please Select']) ?>

                    <?= $form->field($WorkflowDataModel, 'token_from')->dropDownList(['token_url' => 'Token URL'], ['prompt' => 'Please Select']) ?>

                    <?= $form->field($WorkflowDataModel, 'token_url')->textInput(['placeholder' => 'Token URL']) ?>

                    <?= $form->field($WorkflowDataModel, 'username')->textInput(['placeholder' => 'Username']) ?>

                    <?= $form->field($WorkflowDataModel, 'password')->textInput(['placeholder' => 'Password']) ?>
                </div>

                <div class="command_frm_box" style="display:none;">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($WorkflowDataModel, 'application_os')->dropDownList(['Select OS' => '', 'cisco_xe' => 'xe', 'cisco_xr' => 'xr']) ?>
                        </div>
                    </div>

                    <div class="row">

                        <ul class="multiple-command-box">
                            <li>
                                <!-- <a class="btn btn-command-icon"><span class="fa fa-plus-square-o"></span></a> -->
                                <div class="col-md-6">
                                    <?= $form->field($objWorkflowMultipleCommand, 'select_command')->dropDownList([]) ?>
                                </div>
                                <ul class="multiple-condition-box">
                                    <button class="btn btn-info  dim" id="cloneFilterPanelBtn" type="button"><i class="fa fa-plus"></i> </button>
                                    <li class=" jsFilter filter-panel condition-filter-panel" id="jsFilterId-1">
                                        <a class="btn btn-condition-cancel-icon"><span class="fa fa-times"></span></a>
                                        <div class="condition-div-box">
                                            <div class="col-md-3 floatLeft">
                                                <?= $form->field($objWorkflowCommandMultipleCondition, 'condition[]')->dropDownList([]) ?>
                                            </div>
                                            <div class="col-md-3 floatLeft">
                                                <?= $form->field($objWorkflowCommandMultipleCondition, 'operator[]')->dropDownList(['>' => '>', '<' => '<', '!=' => '!=', '==' => '==', '<=' => '<=', '>=' => '>=', 'Store' => 'Store', 'In' => 'In']) ?>
                                            </div>
                                            <div class="col-md-3 floatLeft">
                                                <?= $form->field($objWorkflowCommandMultipleCondition, 'input_val[]')->textInput([]) ?>
                                            </div>
                                            <div class="col-md-3 floatLeft">
                                                <?= $form->field($objWorkflowCommandMultipleCondition, 'logic[]')->textInput([]) ?>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>


                    </div>
                </div>

                <div class="ds_cls" style="display:none;">
                    <?= $form->field($WorkflowDataModel, 'data_source')->dropDownList(['function_name' => 'Function Name', 'form_data' => 'Form Data', 'begnning_data' => 'Data at Begnning', 'prev_process' => 'From Previous Process'], ['prompt' => 'Please Select']) ?>
                </div>
                <div class="func_cls" style="display:none;">
                    <?= $form->field($WorkflowDataModel, 'get_data_function')->dropDownList($functions_get_data_list, ['prompt' => 'Please select Function']) ?>
                </div>
                <div class="formdata_cls" style="display:none;">
                    <?= $form->field($WorkflowDataModel, 'form_data')->textarea(['placeholder' => 'Form Data']) ?>
                </div>
                <input type="hidden" name="element_id" value="<?php echo $element_id; ?>">
                <input type="hidden" name="element_type" value="<?php echo $element_type; ?>">
                <input type="hidden" name="workflow_id" value="<?php echo $workflow_id; ?>">
                <input type="hidden" name="form_json_data" id="form_json_data" value="">
                <input type="hidden" name="saved_form_data" id="saved_form_data" value="">
                <!-- <div class="form-group"> -->
                <!-- <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'savestartevent']) ?> -->
                <!-- <button id="SEClose" type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>