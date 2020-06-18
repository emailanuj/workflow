<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\thresholdSetting\models\MyThresholdSettings */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Threshold Settings';
$this->params['breadcrumbs'][] = $this->title;
$arrGridColumn = [
    ['class' => 'yii\grid\SerialColumn'],

    // 'id',
    'threshold_name',
    'threshold_condition',
    'value',
    // 'is_deleted',
    'updated_at:datetime',
    ['class' => 'yii\grid\ActionColumn', 'template' => '{update}'],
    // ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
    //['class' => 'yii\grid\ActionColumn'],
];

?>
<div class="threshold-settings-index">
    <div class="row">
        <div class="col-sm-12">
            <div class="common-heading"><?= Html::encode($this->title) ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <p>
                        <?= Html::a('Add Threshold Settings', ['create'], ['class' => 'btn btn-primary']) ?>
                    </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => $arrGridColumn,
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>