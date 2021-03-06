<?php
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
?>

<div style="height:500px!important;">
    <div id="mySvg" class="execution" style="position: relative; border-width: 1px; overflow: hidden; width: 100%; height: 100%; border-color: rgb(255, 255, 255); border-style: solid; background-color: rgb(255, 255, 255); background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAwIDEwIEwgNDAgMTAgTSAxMCAwIEwgMTAgNDAgTSAwIDIwIEwgNDAgMjAgTSAyMCAwIEwgMjAgNDAgTSAwIDMwIEwgNDAgMzAgTSAzMCAwIEwgMzAgNDAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI2QwZDBkMCIgb3BhY2l0eT0iMC4yIiBzdHJva2Utd2lkdGg9IjEiLz48cGF0aCBkPSJNIDQwIDAgTCAwIDAgMCA0MCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZDBkMGQwIiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4='); background-position: -1px -1px;"></div>
    
    <div style="position: absolute;height: 500px;top: 0px;left: 0px;width: 100%;"></div>  
</div>
<?php 
    
        $gridColumns = [
                ['class' => 'yii\grid\SerialColumn'],
                'id',            
                'request_params',
                'created_at:datetime',                       
                // 'status',
                [
                    'attribute' => 'status',
                    'label'=>'Status',
                    // 'format'=>'raw',
                    'value' => function($data) { 
                        return ( isset($data['status']) == 0 ) ? 'Fail' : 'Pass';
                    }, 
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => ''],
            ];

    echo ExportMenu::widget([
      'dataProvider' => $dataProvider,
      'columns' => $gridColumns,
      'dropdownOptions' => [
          'label' => 'Export All',
          'class' => 'btn btn-outline-secondary'
      ]
  ]) . "<hr>\n".
  GridView::widget([
      'dataProvider' => $dataProvider,
      'columns' => $gridColumns,
  ]);
    ?>
<?php
    
    if( !empty($workflow_dragram['workflow_diagram'])):
    $this->registerJs(
    "
            var workflow_json = '". $workflow_dragram['workflow_diagram'] ."';
            var workflow_data = '". $model["workflow_data"] ."';
            var workflow_data = '". $model["id"] ."';
            document.addEventListener('DOMContentLoaded', function() {
                if( (workflow_json != '') || workflow_data != '' ){
                    drawGraph(". $workflow_dragram['workflow_diagram'] .",". $model["workflow_data"] .",". $model["id"] .");
                }
            }, false);
        ",
        yii\web\View::POS_END,
        'my-button-handler'
    );
    endif;


?>