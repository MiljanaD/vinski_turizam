<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="d-flex justify-content-center ">
        <div class="col-5 me-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-5">
            <?= $form->field($model, 'street_number')->textInput() ?>

            <?= $form->field($model, 'role')->textInput() ?>

            <?= $form->field($model, 'street')->textInput() ?>

            <?= $form->field($model, 'activated')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'mt-4 w-100 btn-submit-vinskit btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>