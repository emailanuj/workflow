<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'id' => 'workflow_save',
    'options' => [
        'onsubmit' => 'return false'
    ],
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
]); ?>

<div class="input-group col-md-4">
    <input type="text" class="form-control" name="workflow_title" id="workflow_title" placeholder="" value="<?php echo $model['workflow_title']; ?>">
    <input type="hidden" name="workflow_json" id="workflow_json" value="">
    <input type="hidden" name="workflow_data" id="workflow_data" value="">
    <input type="hidden" name="w_id" id="w_id" value="">
    <span class="input-group-append">

        <?= Html::submitButton('Complete Workflow', ['class' => 'btn btn-primary', 'onClick' => 'completeWorkflow()']) ?>
    </span>
</div>
<?php ActiveForm::end(); ?>