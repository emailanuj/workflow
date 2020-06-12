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
    <div class="col-md-6 col-md-offset-2">
        <div class="login-box" style="width: auto; margin:0px; padding: 5px 15px 15px; border: 1px solid #bbb; border-radius: 10px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
                    <p class="text-center">Please fill following fields</p>
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'layout' => 'horizontal'
                    ]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    <div style="color:#999;margin:1em 0">
                        If you forgot your password you can <?= Html::a('reset it', ['user/request-password-reset']) ?>.
                        For new user you can <?= Html::a('signup', ['user/signup']) ?>.
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-12">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>