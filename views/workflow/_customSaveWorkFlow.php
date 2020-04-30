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
    'action'  => 'workflow/save-workflow',
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
                                      <input value="" type="text" class="input-text" placeholder="" value="Testing">
                                  </span>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="page-action-wrapper text-right">
                               <?= Html::submitButton('Complete Workflow', ['class' => 'btn btn-comman', 'name' => 'contact-button','onClick'=>'clearLocalStorage()' ]) ?>
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