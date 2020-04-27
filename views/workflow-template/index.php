<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkflowTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workflow Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workflow-template-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Workflow Template', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'workflow_template_title',
            'workflow_template_description',            
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                // 'template' => '{view}{update}{delete}',                
                'template' => '{view}{update} {delete} {create-process}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'view'),
                        ]);
                    },

                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('app', 'update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'delete'),
                        ]);
                    },
                    'create-process' => function ($url, $model) {
                        if($model->workflow_id == '0') {
                            $url = Url::base().'/workflow/create?id='.$model->id;
                            return Html::a('<button type="button" class="btn btn-success btn-sm">Add Process</button>', $url, [
                                        'title' => Yii::t('app', 'workflow-create'),
                            ]);
                        } else {
                            $url = Url::base().'/workflow/update?id='.$model->id;
                            return Html::a('<button type="button" class="btn btn-success btn-sm">modify Process</button>', $url, [
                                'title' => Yii::t('app', 'workflow-update'),
                            ]); 
                        }
                    }
                ],  
                'urlCreator' => function ($action, $model, $key, $index) {                    
                    if ($action === 'view') {
                        $url = Url::base().'/workflow-template/view?id='.$model->id;
                        return $url;
                    }
                    if ($action === 'update') {
                        $url = Url::base().'/workflow-template/update?id='.$model->id;
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = Url::base().'/workflow-template/delete?id='.$model->id;
                        return $url;
                    }
                  }
                            
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
