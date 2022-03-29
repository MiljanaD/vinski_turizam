<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \common\models\LoginForm $model */

use yii\base\Model;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\db\Query;

$this->title = 'Prijava';
$this->context->layout = 'landing';
$dataArray = \common\models\Adresa::find()->all();

$opstine = [];
$mjesta = [];
$ulice = [];

foreach ($dataArray as $data)
{
    $opstine[$data['opstina']] = $data['opstina'];
    $mjesta[$data['mjesto']] = $data['mjesto'];
    $ulice[$data['ulica']] = $data['ulica'];
}

?>
<div class="col-lg-3 position-absolute register-box p-2 site-signup">
    <div>
        <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>

        <?= $form->field($model, 'ime')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'lozinka')->passwordInput() ?>

        <?= $form->field($model, 'lozinkaPonovo')->passwordInput() ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'brojTelefona') ?>

        <?= $form->field(new \common\models\Adresa(),'mjesto')->dropDownList($mjesta,
            ['prompt'=>'-izaberi mjesto-',
            'onchange'=>'
				$.post( "'.Yii::$app->urlManager->createUrl('post/lists?id=').'"+$(this).val(), function( data ) {
				  $( "select#title" ).html( data );
				});
			']); ?>

        <?= $form->field(new \common\models\Adresa(),'opstina')->dropDownList($opstine); ?>

        <?= $form->field(new \common\models\Adresa(),'ulica')->dropDownList($ulice); ?>


        <div class="form-group d-flex flex-column">
            <?= Html::submitButton('Registruj se', ['class' => 'mt-3 mb-2 btn btn-danger', 'name' => 'login-button'],) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
