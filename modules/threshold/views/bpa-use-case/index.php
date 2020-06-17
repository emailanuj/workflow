<?php
use yii\helpers\Html;
//use yii\helpers\BaseUrl;
use yii\helpers\ArrayHelper;
//use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */

$this->title = 'BPA AUC 2.1 UI Reports';
$this->params['breadcrumbs'][] = $this->title;

$utilization        = array("peak" => "peak", "average" => "average", "95precentile" => "95 precentile");
$duration           = array("1hr" => "1 HR", "1day" => "1 Day", "7days" => "7 Days");
$utilizationType    = array("QOSclassbased" => "Class Based", "combined" => "Combined");
?>
<div class="bpa-usecase-index">

    <h1><?= Html::encode($this->title) ?></h1><br/>
    <?php //echo '<pre/>'; print_r($data); ?>
    

    <?= Html::beginForm(['bpa-use-case/topology'], 'POST', ['class' => 'form-vertical','name' => 'bpa-search','id' => 'bpa-search','onsubmit' => 'return false']); ?>
    <div class="form-group col-md-2">
        <?= Html::dropDownList('utilization', '', $utilization, ['class' => 'form-control']); ?>
    </div>
    <div class="form-group col-md-2">
        <?= Html::dropDownList('duration', '', $duration, ['class' => 'form-control']); ?>
    </div>
    <div class="form-group col-md-2">
        <?= Html::dropDownList('utilization_type', '', $utilizationType, ['class' => 'form-control']); ?>
    </div>
    <div class="form-group col-md-2">
        <?= Html::textInput('Aend_host', '', ['class' => 'form-control','placeholder' =>'AEnd Host']) ?>
    </div>
    <div class="form-group col-md-2">
        <?= Html::textInput('Aend_ip', '', ['class' => 'form-control','placeholder' =>'AEnd IP']); ?>
    </div>
    <div class="form-group col-md-2">
        <?= Html::textInput('Zend_host', '', ['class' => 'form-control','placeholder' =>'ZEnd Host']); ?>
    </div>
    <div class="form-group col-md-2">
        <?= Html::textInput('Zend_ip', '', ['class' => 'form-control','placeholder' =>'ZEnd IP']); ?>
    </div>
    <div class="form-group col-md-2">
        <?= Html::Button('Search', ['class' => 'btn btn-primary', 'id' => 'searchbpareport']); ?>
    </div>
    <?= Html::endForm(); ?>

    <div class="bpa-usecase-data" id="bpareportdata">

    </div>
    
</div>
