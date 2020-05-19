<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkflowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workflows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workflow-index">    
    <div id="form-popup">   
    <div id="loading" style="position:absolute;display:none;">
        <img src="<?= Url::base().'/images/loading.gif'; ?>" style="margin-left:400px;"/></div>     
        <span id="close" onclick="closeForm()" style="margin-top:0px!important;">
            <img src="<?= Url::base().'/images/pop-close.png'; ?>" />
        </span>    
    </div>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    	<button id="saveWorkflowModal" class="btn btn-success" data-toggle="modal" data-target="#FModal">Create Workflow</button>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'workflow_title',
            'workflow_description',
            'created_at:datetime',
            //'workflow_data:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}{clone}{execute}',
                'buttons' => [
                    'clone' => function ($url, $model, $key) {
                        //<span class="glyphicon glyphicon-duplicate" onclick="openform('.$key.')"></span>
                        return Html::a(
                            ' <span class="glyphicon glyphicon-duplicate"></span>',
                            '#', 
                            [
                                'id'=>"createWorkflowClone",
                                'actual-id' => $key,
                                'class' => 'clone-view-link',
                                'title' => Yii::t('yii', 'Clone'),
                                'data-pjax' => '0',
                        ]);
                    },
                    'execute' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-hourglass"></span>',
                            Url::base().'/workflow-execution/index?id='.$key, 
                            [
                                'title' => 'Execute',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                    
                ],
            ],
        ],
    ]); ?>  
</div>