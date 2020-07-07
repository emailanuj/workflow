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
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ]);
    ?>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2"><?= $form->field($bandwidthCircuitServiceModel, 'circuit_id')->textInput([]) ?></div>
            <div class="col-md-2"><?= $form->field($bandwidthCircuitServiceModel, 'vpn_id')->textInput([]) ?></div>
            <div class="col-md-2"><?= $form->field($bandwidthCircuitServiceModel, 'role_id')->textInput([]) ?></div>
            <div class="col-md-2"><?= $form->field($bandwidthCircuitServiceModel, 'primary_interface')->textInput([]) ?></div>
            <div class="col-md-2"><?= $form->field($bandwidthCircuitServiceModel, 'secondary_interface')->textInput([]) ?></div>
            <div class="col-md-2"><?= $form->field($bandwidthCircuitServiceModel, 'qos_bandwidth')->textInput([]) ?></div>
        </div>                
    </div>
    
    <div class="row">
        <div class="col-md-10"></div>        
        <div class="col-md-2">
            <?= Html::Button('Search', ['class' => 'btn btn-primary', 'id' => 'searchbpacircuitreport']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="bpa-usecase-circuit-data" id="bpacircuitreportdata">

    </div>

</div>