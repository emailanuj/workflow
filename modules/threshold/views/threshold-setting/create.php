<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ThresholdSettings */

$this->title = 'Create Threshold Settings';
$this->params['breadcrumbs'][] = ['label' => 'Threshold Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

$this->registerJsFile('@web/js/thresholdsetting.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="threshold-settings-create">
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
						'model' => $model, 'kpiList' => $kpiList, 'thresholdNetworks' => $thresholdNetworks,'thresholdServices' => $thresholdServices,'thresholdTags' => $thresholdTags,'thresholdUtilizations' => $thresholdUtilizations, 'thresholdCondition' => $thresholdCondition, 'status' => $status
					]) ?>
				</div>
			</div>
		</div>
	</div>
</div>
