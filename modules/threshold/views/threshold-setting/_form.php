<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ThresholdSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="threshold-settings-form">

    <?php $form = ActiveForm::begin([
    'fieldConfig' => ['options' => ['class' => 'form-group col-md-6']],
]); ?>
    
        <?php if($model->isNewRecord){ ?>
            <?= $form->field($model, 'threshold_name')->dropDownList($kpiList, ['prompt'=>'Select KPI']); ?>

            <?= $form->field($model, 'threshold_condition')->dropDownList($thresholdCondition, ['prompt'=>'Select  Condition']); ?>

            <div id="customOption" style="display: none"> 

                <h2><a href="#" id="addScnt">Add Another Input Box</a></h2>
                <div id="p_scents">
                    <p>
                        <label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt" value="" placeholder="Input Value" /></label>
                    </p>
                </div>
            </div>

            <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'is_deleted')->dropDownList($status, ['prompt'=>'Select Status']); ?>

            <?= $form->field($model, 'created_by')->hiddenInput(['value'=> Yii::$app->user->id])->label(false); ?>

            <?= $form->field($model, 'updated_by')->hiddenInput(['value'=> Yii::$app->user->id])->label(false); ?>

            <?= $form->field($model, 'created_at')->hiddenInput(['value'=> date('Y-m-d H:i:s')])->label(false); ?>

            <?= $form->field($model, 'updated_at')->hiddenInput(['value'=> date('Y-m-d H:i:s')])->label(false); ?>
        <?php } 
        else { ?>
            <?= $form->field($model, 'threshold_name')->textInput(['maxlength' => true, 'disabled' => true]) ?>

            <?= $form->field($model, 'threshold_condition')->dropDownList( $thresholdCondition, ['prompt'=>'Select Condition'] ); ?>
            <?php //$form->field($model, 'condition')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'is_deleted')->dropDownList($status, ['prompt'=>'Select Status']); ?>

            <?= $form->field($model, 'updated_by')->hiddenInput(['value'=> Yii::$app->user->id])->label(false); ?>
            
            <?= $form->field($model, 'updated_at')->hiddenInput(['value'=> date('Y-m-d H:i:s')])->label(false); ?>
            <?php //$form->field($model, 'updated_at')->textInput() ?>
        <?php } ?>

        <div class="form-group text-center rm-margin">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
