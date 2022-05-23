<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VineRegion */
/* @var $form yii\widgets\ActiveForm */
?>
    <div class="vine-region-form w-75 m-auto">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'GPS_coordinates')->textInput(['maxlength' => true]) ?>

        <div class="d-flex justify-content-center">
            <?= Html::submitButton('Save', ['class' => 'mt-4 w-50 btn-submit-vinskit btn btn-success']) ?>
        </div>


        <?php ActiveForm::end(); ?>

</div>