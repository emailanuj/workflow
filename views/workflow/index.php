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
        <span id="close" onclick="closeForm()" style="margin-top:0px!important;"><img src="<?= Url::base().'/images/pop-close.png'; ?>" /></span>    
        <div class="form-container">
                <h3>Clone Form</h3>
                <?= $this->render('_customCloneForm', [
                    'clonemodel' => $clonemodel
            ]) ?>
        </div>
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

            'id',
            'workflow_title',
            'workflow_description',
            //'workflow_data:ntext',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}{clone}{execute}',
                'buttons' => [
                    'execute' => function ($url) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-hourglass"></span>',
                            $url, 
                            [
                                'title' => 'Execute',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                    'clone' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-duplicate" onclick="openform('.$key.')"></span>','#', [
                            'class' => 'clone-view-link',
                            'title' => Yii::t('yii', 'Clone'),
                            'data-toggle' => 'modal',
                            'data-target' => '#clone-modal',
                            'data-id' => $key,
                            'data-pjax' => '0',
        
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>

<!--------------------------------------------------- Modal For Saving Data ------------------------->
<div id="workflowmodal" class="modal"> 
      <!-- Modal content -->
      <div class="modal-content" class="workflowmodal" style="width: 500px; margin-left:500px;margin-top:100px;">
      <?= $this->render('_customWorkflowSaveForm',[
    'workflowModel' => $workflowModel
]) ?>
      </div>
</div>
<!-- ----------------------------------------------------------End ---------------------------------->