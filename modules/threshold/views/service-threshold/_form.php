<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceThreshold */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-threshold-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?php 	
	echo $form->field($model, 'service_type')->dropDownList([""=>"Select Service",
			"L3VPN"=>"L3VPN",
			"L2VPN"=>"L2VPN",
			"ISP"=>"ISP"],['style'=>'width: 30%; height: 34px;']);
    ?>

	<?php 	
	echo $form->field($model, 'tags')->dropDownList([""=>"Select Tags",
			"NNI"=>"NNI",
			"Expressway"=>"Expressway",
			"Backbone"=>"Backbone",
			"Backbone-B2B"=>"Backbone-B2B",
			"Access Links"=>"Access Links"
			], ['style'=>'width: 30%; height: 34px;']);
    ?>
	
    <?php 	
	//$range = range(65, 100, 5);
	$range = array_combine(range(60, 100, 5), range(60, 100, 5));
	
	echo $form->field($model, 'threshold_for_peak_in_last_15days')->dropDownList($range,
			['style'=>'width: 30%; height: 34px;', 'prompt'=>'Select threshold'])->label("Select Threshold");
    ?>
	
	<?php 	
	echo $form->field($model, 'threshold_for_current_utilisation')->dropDownList($range,
			['style'=>'width: 30%; height: 34px;', 'prompt'=>'Select threshold'])->label("Select Threshold");
    ?>
	
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
