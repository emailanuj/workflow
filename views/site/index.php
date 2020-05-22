<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'Dashboard';

?>
<div class="site-index">
    <h5 class="mb-2 mt-4">Dashboard Details </h5>
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $workflow_count ?></h3>

                <p>Total Workflow Count</p>
              </div>
              <div class="icon">
              </div>
              <a href="<?= Url::to(['/workflow']) ?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          
        <div class="col-lg-3 col-6">
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?= $workflow_execution ?></h3>

                <p>Total Execution Count</p>
              </div>
              <div class="icon">
              </div>
              <a href="<?= Url::to(['/workflow-execution-reports']) ?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        <!--
          <div class="col-lg-3 col-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div> -->
        </div>

</div>
