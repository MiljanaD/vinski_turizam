<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->context->layout = 'landing';
?>
<div class="position-absolute login-box p-4 site-login">
    <div>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'lozinka')->passwordInput() ?>

        <?= $form->field($model, 'zapamtiMe')->checkbox(['class' => 'form-check-input remember-me']) ?>

        <div class="my-1 mx-0" style="color:#999;">
            Ako ste zaboravili sifru, mozete je <?= Html::a('resetovati', ['site/request-password-reset'],
                ['class' => 'red-text-link']) ?>.
            <br>
            Trebate novi verifikacijski mail? <?= Html::a('Posalji ponovo.', ['site/resend-verification-email'],
                ['class' => 'red-text-link']) ?>
        </div>

        <div class="form-group d-flex flex-column">
            <?= Html::submitButton('Prijavi se', ['class' => 'mt-3 mb-2 btn btn-danger', 'name' => 'login-button'],) ?>
            <p class="text-center mb-0"> ili </p>
            <?= Html::a('Registruj se',\yii\helpers\Url::to('signup'), ['class' => 'mt-2 btn btn-secondary', 'name' => 'register-button'],) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
