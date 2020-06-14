<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TblKeywords;
use yii\helpers\ArrayHelper;
use app\models\TblFunctions;
use yii\helpers\Url;

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
<div id="properties">
          <div id="close">
              <img src="<?= Url::base() .'/images/pop-close.png'?>">
          </div>
          <p id="title-properties">Set Field Parameters</p>
          <div id="proplist">
    	<div class="container-fluid">
            <div class="panel-body">                
                <?= $form->field($workflowStartEventModel, 'step_no')->textInput(['autofocus' => true,'placeholder'=>'Step No', 'type' => 'number']) ?>                
                <?= $form->field($workflowStartEventModel, 'next_process')->textInput(['placeholder'=>'Step No', 'type' => 'number']) ?>
                <?= $form->field($workflowStartEventModel, 'condition_statement')->textInput(['placeholder'=>'Step No']) ?>
                <?= $form->field($workflowStartEventModel, 'if_fail')->dropDownList(['stop' => 'Stop','continue'=>'Continue'],['prompt'=>'Please Select']) ?>
     			<input type="hidden" name="element_id" value="<?php echo $element_id;?>">
     			<input type="hidden" name="element_type" value="<?php echo $element_type;?>">
     			<input type="hidden" name="workflow_id" value="<?php echo $workflow_id;?>">
     			<input type="hidden" name="form_json_data" id="form_json_data" value="">                 
                <div class="form-group">
                  <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'savestartevent' ]) ?>
                    <button id="SEClose" type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                </div>
          </div>
      </div>
      </div>
     </div>
<?php ActiveForm::end(); ?>