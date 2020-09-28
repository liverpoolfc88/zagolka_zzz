<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShopcartOrders */

$this->title = 'Maxsulotlarni taxrirlash: ' . $model->good_id;
$this->params['breadcrumbs'][] = ['label' => 'Shopcart Orders', 'url' => ['index']];

// $this->params['breadcrumbs'][] = 'Update';
?>
    <h1><?//= Html::encode($this->title) ?></h1>
<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<div class="shopcart-orders-update">


    <div class="shopcart-orders-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'count')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <a href='javascript:history.back()' class='btn btn-danger'>ortga</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
		</div>
	</div>
</div>

