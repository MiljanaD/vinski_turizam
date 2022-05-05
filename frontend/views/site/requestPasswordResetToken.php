<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \frontend\models\PasswordResetRequestForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Zahtjev za resetovanje lozinke';
$this->context->layout = 'landing';
?>
<div class="d-flex h-100 justify-content-center align-items-center">
    <div class="site-request-password-reset p-5"  style="background: rgba(255, 255, 255, 0.3)">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Unesite Vas email u polje ispod. Link za resetovanje lozinke ce Vam biti poslat putem email-a.</p>

        <div class="row">
            <div class="">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn-reset-pass-submit btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
