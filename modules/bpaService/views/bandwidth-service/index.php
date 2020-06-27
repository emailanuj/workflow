<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Bandwidth Service';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/bpa-service.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="bpa-usecase-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php

    $form = ActiveForm::begin([
        'id' => 'bpa-search',
        'options' => [
            'onsubmit' => 'return false',
            'name' => 'bandwidth_service'
        ],
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ]);
    ?>

<div class="form-group circuitgroup">
<div class="row">
    <div class="col-md-3">
        <?= $form->field($bandwidthServiceModel, 'network')->dropDownList($networks, ['prompt' => 'Please Select']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($bandwidthServiceModel, 'service')->dropDownList($services, ['prompt' => 'Please Select']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($bandwidthServiceModel, 'tag')->dropDownList($tags, ['prompt' => 'Please Select']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($bandwidthServiceModel, 'utilization')->dropDownList($utilization, ['prompt' => 'Please Select']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($bandwidthServiceModel, 'duration')->dropDownList($duration, ['prompt' => 'Please Select']) ?>
    </div>
    <div class="col-md-3 durationfilterselector" style="display:none">
        <?= $form->field($bandwidthServiceModel, 'duration_filter')->dropDownList(['prompt' => 'Please Select']) ?>
    </div>    
    <div class="col-md-3">
        <?= $form->field($bandwidthServiceModel, 'utilization_type')->dropDownList($utilizationType, ['prompt' => 'Please Select']) ?>
    </div>
    </div>
    <div class="row multicircuit" id="multicircuit0">
    <div class="col-md-3">
        <?= $form->field($bandwidthServiceModel, 'a_end_host[]')->textInput([]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($bandwidthServiceModel, 'z_end_host[]')->textInput([]) ?>
    </div>
        <div class="col-md-1" style="margin-top:30px!important;"><a class="addfields" style="margin-top:10px;cursor:pointer;"><i class="fa fa-plus-circle"></i></a></div>           
        <div class="col-md-1" style="margin-top:30px!important;"><a class="rmfields" style="margin-top:10px;cursor:pointer;"><i class="fa fa-minus-circle"></i></a></div>           
    </div>    
</div>
    <div class="col-md-12" style="float:right;">
        <?= Html::Button('Search', ['class' => 'btn btn-primary', 'id' => 'searchbpareport']); ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="bpa-usecase-data" id="bpareportdata">

    </div>

</div>