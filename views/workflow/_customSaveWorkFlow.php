<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $workflowDataModel app\models\Workflow */
/* @var $form yii\widgets\ActiveForm */
?>
  <!-- <form id="seModal0" action="" name="seModal0"> -->
  <?php $form = ActiveForm::begin([
    'id' => 'workflow_save',
    'action'  => 'save-workflow',
  ]); ?>
   <form id="w0" action="" method="post">
   <section class="content">
          <div>
              <div class="title-breadcrumb" style="margin:0; padding:0">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-8">
                              <div class="page-title-div">
                                  <span>
                                      <img src="<?= Url::base() .'/images/icons/title-workflow-execution-dark.png'?>">
                                      <input type="text" class="input-text" name="workflow_title" placeholder="" value="<?php echo $model['workflow_title'];?>">
                                      <input type="hidden" name="workflow_json" id="workflow_json" value="">
                                      <input type="hidden" name="workflow_data" id="workflow_data" value="">
                                      <input type="hidden" name="w_id" id="w_id" value="">
                                  <?= Html::submitButton('Complete Workflow', ['class' => 'btn btn-comman','onClick'=>'completeWorkflow()' ]) ?>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>    
   </form>
  <?php ActiveForm::end(); ?>
  <!-- </form> -->