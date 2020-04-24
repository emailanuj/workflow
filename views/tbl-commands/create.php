<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblCommands */

$this->title = 'Create Tbl Commands';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Commands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-commands-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
