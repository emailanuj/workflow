<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-6" style="margin:0px auto;">
        <div class=" ibox-content">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
            <p class="text-center">Please fill following fields</p>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
            ]); ?>

            <div class="form-group required">
            <!-- 'options' => ['tag' => false] // used in tempelete -->
                <?= $form->field($model, 'username', ['template' => '{input}'])->textInput(['autofocus' => true, 'placeholder' => 'Username', 'class' => 'form-control']) ?>
            </div>
            <?= $form->field($model, 'password',['template' => '{input}'])->passwordInput(['placeholder' => 'Password', 'class' => 'form-control']) ?>

            <?= $form->field($model, 'rememberMe', ['template' => '{input}'])->checkbox() ?>

            <!-- <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['user/request-password-reset']) ?>.
                For new user you can <?= Html::a('signup', ['user/signup']) ?>.
            </div> -->

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-12">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary block full-width m-b', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>