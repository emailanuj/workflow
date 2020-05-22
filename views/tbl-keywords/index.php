<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblKeywordsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Keywords';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-keywords-index">

    <div class="col-md-6 absoluteClm">
        <div class="page-action-wrapper text-right">
            <span class="table-search-icon">
                <button class="btn-transparent btn-search" id="TableSearch"><img src="<?= Url::base() .'/images/search-icon.png'?>"></button>
            </span>                                           
            <button class="btn btn-update"><?= Html::encode($this->title) ?></button>
        </div>
    </div>

    <p>
        <?= Html::a('Create Tbl Keywords', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'keyword_name',
            //'is_deleted',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
