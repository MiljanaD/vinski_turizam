<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VineService */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vine-service-form w-75 m-auto">

    <?php $form = ActiveForm::begin(['id' => 'create_vine_service']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="d-flex justify-content-center">
        <?= Html::submitButton('Save', ['class' => 'mt-4 w-50 btn-submit-vinskit btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>