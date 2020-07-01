<?php
$this->title = 'Create Workflow';
$this->params['breadcrumbs'][] = ['label' => 'Workflow', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_customWorkflowForm', [
    'model' => $model,'workflow_id'=>$workflow_id
]) ?>


