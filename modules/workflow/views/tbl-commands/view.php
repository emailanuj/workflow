<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblCommands */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Commands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-commands-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'command_name',
            // 'is_deleted',
            [
                'attribute' => 'is_deleted',
                'label' => 'Status',
                'value' => function ($model){
                    return ( $model->is_deleted == 0 ) ? 'Active' : 'No-Active';
                },
            ],
            'created_at:date',
            'created_by',
            'created_at:date',
            'updated_by',
        ],
    ]) ?>

</div>
