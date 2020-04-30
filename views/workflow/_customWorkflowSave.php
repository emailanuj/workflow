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
    //'action'  => 'user-default-shipping/create',
    'options' => [
      'onsubmit' => 'return false'
  ]
  ]); ?>
   <section class="content">
          <div>
              <div class="title-breadcrumb" style="margin:0; padding:0">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-8">
                              <div class="page-title-div">
                                  <span>
                                      <img src="<?= Url::base() .'/images/icons/title-workflow-execution-dark.png'?>">
                                      <input value="" type="text" class="input-text" placeholder="Untitled Workflow Diagram">
                                      <button class="btn btn-edit" type="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                                      <!-- <div class="input-group input-text">
                                        <input type="text" class="form-control" placeholder="Edit">
                                        <span class="input-group-btn">
                                          <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
                                        </span>
                                      </div> -->
                                  </span>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="page-action-wrapper text-right">
                                  <button class="btn btn-comman">Save Workflow</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  <?php ActiveForm::end(); ?>
  <!-- </form> -->