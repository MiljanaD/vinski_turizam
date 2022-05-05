<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \frontend\models\ResetPasswordForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->context->layout = 'landing';
$this->title = 'Resetovanje lozinke';
?>
<div class="d-flex h-100 justify-content-center align-items-center">
    <div class="site-reset-password p-5"  style="background: rgba(255, 255, 255, 0.3)">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Unesite novu lozinku:</p>

        <div class="row">
            <div class="">
                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn-reset-pass-submit btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
