<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Workflow */
/* @var $form yii\widgets\ActiveForm */
$clones = array('structure'=>'structure','data'=>'data');
?>

<div class="clone-form">

    <?php $form = ActiveForm::begin([
        'id' => 'formclone',
        'action' => Url::base().'/workflow/clone',
        'options' => [
            'onsubmit' => 'return false'
        ]

    ]); ?>

    <?= $form->field($clonemodel,'clone_title')->textInput(['maxlength' => true]); ?>
    <?= $form->field($clonemodel,'clone_description')->textInput(['maxlength' => true]); ?>
    <?= $form->field($clonemodel,'clone_type')->dropDownList($clones,['prompt'=> 'select Clone Type']);   ?>

    <?= Html::activeHiddenInput($clonemodel,'clone_id'); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id' => 'clonesubmit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
