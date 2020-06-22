<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Circuit Bandwidth Service';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/bpa-service.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="bpa-usecase-circuit-index">
    <!-- <h3><?= Html::encode($this->title) ?></h3> -->
    <?php

    $form = ActiveForm::begin([
        'id' => 'bpa-circuit-search',
        'options' => [
            'onsubmit' => 'return false',
            'name' => 'bandwidth_circuit_service'
        ],
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ]);
    ?>
    <div class="form-group row circuitgroup">
        <div class="row multicircuit" id="multicircuit1">
            <div class="col-md-3">
                <?= $form->field($bandwidthCircuitServiceModel, 'a_end_host[]')->textInput([]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($bandwidthCircuitServiceModel, 'a_end_ip[]')->textInput([]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($bandwidthCircuitServiceModel, 'z_end_host[]')->textInput([]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($bandwidthCircuitServiceModel, 'z_end_ip[]')->textInput([]) ?>
            </div> 
            <div class="col-md-1" style="margin-top:30px!important;"><a class="addfields" style="margin-top:10px;cursor:pointer;"><i class="fa fa-plus-circle"></i></a></div>           
            <div class="col-md-1" style="margin-top:30px!important;"><a class="rmfields" style="margin-top:10px;cursor:pointer;"><i class="fa fa-minus-circle"></i></a></div>           
        </div>                
    </div>
    
    <div class="row">
        <div class="col-md-8"></div>        
        <div class="col-md-2">
            <?= Html::Button('Search', ['class' => 'btn btn-primary', 'id' => 'searchbpacircuitreport']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="bpa-usecase-circuit-data" id="bpacircuitreportdata">

    </div>

</div>