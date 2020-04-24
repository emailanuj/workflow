<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MongoWorkFlow */

$this->title = 'Create Mongo Work Flow';
$this->params['breadcrumbs'][] = ['label' => 'Mongo Work Flows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mongo-work-flow-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
