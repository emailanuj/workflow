<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceThresholdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Thresholds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-threshold-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Service Threshold', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'service_type',
            'tags',
            'threshold_for_peak_in_last_15days',
            'threshold_for_current_utilisation',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
