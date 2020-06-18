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

<div class="form-group row">
<div class="col-md-2">
        <?= $form->field($bandwidthServiceModel, 'utilization')->dropDownList($utilization, ['prompt' => 'Please Select']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($bandwidthServiceModel, 'duration')->dropDownList($duration, ['prompt' => 'Please Select']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($bandwidthServiceModel, 'utilization_type')->dropDownList($utilizationType, ['prompt' => 'Please Select']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($bandwidthServiceModel, 'a_end_host')->textInput([]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($bandwidthServiceModel, 'a_end_ip')->textInput([]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($bandwidthServiceModel, 'z_end_host')->textInput([]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($bandwidthServiceModel, 'z_end_ip')->textInput([]) ?>
    </div>
    <div class="col-md-2">

        <?= Html::Button('Search', ['class' => 'btn btn-primary', 'id' => 'searchbpareport']); ?>
    </div>
</div>
    

    <?php ActiveForm::end(); ?>

    <div class="bpa-usecase-data" id="bpareportdata">

    </div>

</div>