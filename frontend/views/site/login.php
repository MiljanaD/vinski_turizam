<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Modal;
use yii\helpers\Url;

$this->title = 'Login';
$this->context->layout = 'landing';
?>
<div class="position-absolute login-box p-4 site-login">
    <div>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="my-1 mx-0" style="color:white;">
            Ako ste zaboravili sifru, mozete je <?= Html::a('resetovati.', ['site/request-password-reset'],
                ['class' => 'black-text-link']) ?>
        </div>

        <div class="form-group d-flex flex-column">
            <?= Html::submitButton('Prijavi se', ['class' => 'mt-3 mb-2 btn btn-danger', 'name' => 'login-button'],) ?>
            <p class="text-center mb-0"> ili </p>
            <?= Html::button('Registruj se', ['value' => Url::to('signup'), 'id' => 'openSignUp', 'class' => 'mt-2 btn btn-secondary', 'name' => 'register-button'],) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <div class="d-flex justify-content-center">
            <?= Html::a('<i class="fa fa-home"></i> Početna strana', Url::to('index'), ['class' => 'mt-4 btn btn-secondary']) ?>
        </div>
    </div>

    <?php

    Modal::begin(['id' => 'signUpModal', 'title' => 'Registracija', 'titleOptions' => ['class' => 'blackText text-center w-100']]); ?>
    <div class="loader"></div>
    <?php Modal::end();

    ?>
</div>
