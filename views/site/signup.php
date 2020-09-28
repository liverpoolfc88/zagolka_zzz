<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title; // <-- Небольшая навигация
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'repeatpass')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>
        <div class="col-md-6">            
            <?= $form->field($model, 'fio')->textInput() ?>
            <?= $form->field($model, 'tel') ?>
            <?= $form->field($model, 'address')->textInput() ?>
            <?= $form->field($model, 'remark')->label('To`liq address') ?>
        </div>
            <?php ActiveForm::end(); ?>

    </div>
</div>