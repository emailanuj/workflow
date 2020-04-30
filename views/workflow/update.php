<?= $this->render('_customWorkflowForm', [
    'model' => $model,'workflow_id'=>$workflow_id
]) ?>
<?php
    $this->registerJs(
    "
            var workflow_json = '". $model["workflow_json"] ."';
            var workflow_data = '". $model["workflow_data"] ."';
            document.addEventListener('DOMContentLoaded', function() {
                if( (workflow_json != '') || workflow_data != '' ){
                drawGraph(". $model["workflow_json"] .",". $model["workflow_data"] .");
}
            }, false);
    ",
    yii\web\View::POS_END,
    'my-button-handler'
);
?>

    
