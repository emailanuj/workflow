<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MongoWorkFlow */

$this->title = 'Update Mongo Work Flow: ' . $model->_id;
$this->params['breadcrumbs'][] = ['label' => 'Mongo Work Flows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->_id, 'url' => ['view', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mongo-work-flow-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
