<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */

$this->title = 'Bandwidth Service';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/bpa-service.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="bpa-usecase-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php $form = ActiveForm::begin(['id' => 'bpa-search', 'options' => [
            'onsubmit' => 'return false',            
        ],]); ?>
    <?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items', // required: css class selector
    'widgetItem' => '.item', // required: css class
    'limit' => 4, // the maximum times, an element can be cloned (default 999)
    'min' => 1, // 0 or 1 (default 1)
    'insertButton' => '.add-item', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $modelsBandwidth[0],
    'formId' => 'bpa-search',
    'formFields' => [
        'utilization',
        'duration',
        'duration_filter',
        'utilization_type',
        'a_end_host',
        'z_end_host',
    ],
]); ?>
    <div class="container-items"><!-- widgetContainer -->
        <?php foreach ($modelsBandwidth as $i => $modelBandwidth): ?>
            <div class="item"><!-- widgetBody -->
                <div class="pull-right" style="margin-top:30px;">
                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                </div>                    
                <div class="row">
                    <div class="col-sm-2">
                        <?= $form->field($modelBandwidth, "[{$i}]utilization")->dropDownList($utilization, ['prompt' => 'Please Select']) ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($modelBandwidth, "[{$i}]duration")->dropDownList($duration, ['class' => 'durationfclass form-control','prompt' => 'Please Select', 'onChange' => 'getHourDay()']) ?>
                    </div>
                    <div class="col-sm-2 durationfilterselector">
                        <?= $form->field($modelBandwidth, "[{$i}]duration_filter")->dropDownList($duration_filter, ['prompt' => 'Please Select']) ?>
                    </div>                                                
                    <div class="col-sm-2">
                        <?= $form->field($modelBandwidth, "[{$i}]utilization_type")->dropDownList($utilizationType, ['prompt' => 'Please Select']) ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($modelBandwidth, "[{$i}]a_end_host")->textInput([]) ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($modelBandwidth, "[{$i}]z_end_host")->textInput([]) ?>
                    </div> 
                </div>                    
                </div>
            <?php endforeach; ?>
        </div>
    <?php DynamicFormWidget::end(); ?>            
    <div class="form-group row">
        <div class="col-sm-12"><?= Html::submitButton('search', ['class' => 'btn btn-primary col-sm-2','id' => 'searchbpareport', 'style' => 'float:right;']) ?></div>
    </div>
    <?php ActiveForm::end(); ?>    

<div class="bpa-usecase-data" id="bpareportdata">

</div>

</div>