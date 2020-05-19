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

    <?= $form->field($clonemodel,'clone_type')->dropDownList($clones,['prompt'=> 'select Clone Type']);   ?>

    <?= $form->field($clonemodel,'clone_id')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id' => 'clonesubmit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
