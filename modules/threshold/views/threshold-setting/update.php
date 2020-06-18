<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ThresholdSettings */

$this->title = 'Update Threshold Settings: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Threshold Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="threshold-settings-update">
	<div class="row">
		<div class="col-sm-12">
			<div class="common-heading"><?= Html::encode($this->title) ?></div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<?= $this->render('_form', [
						'model' => $model, 'thresholdCondition' => $thresholdCondition, 'status' =>$status
					]) ?>
				</div>
			</div>
		</div>
	</div>
</div>
