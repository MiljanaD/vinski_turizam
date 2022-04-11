<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \common\models\SignupForm $model */

use common\models\City;
use common\models\Municipality;
use common\models\Street;
use yii\base\Model;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\db\Query;
use yii\helpers\ArrayHelper;

$this->title = 'Prijava';
$this->context->layout = 'landing';
$cities = ArrayHelper::map(City::find()->asArray()->all(), 'id', 'name');
?>
<div class="p-2 blackText">
    <div>
        <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>
        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'surname')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'passwordAgain')->passwordInput() ?>

        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'phoneNumber') ?>

        <?= $form->field(new City(), 'name')->dropDownList($cities,
            ['prompt' => '-Izaberite grad-',
                'onchange' => '
				$.post( "' . Yii::$app->urlManager->createUrl('adress/municipality?id=') . '"+$(this).val(), function( data ) {
				  $( "select#municipality" ).html( data );
				});
			']) ?>
        <?= $form->field(new Municipality(), 'name')
            ->dropDownList(
                [],
                ['id' => 'municipality', 'prompt' => '-Izaberite opstinu-',
                    'onchange' => '
				$.post( "' . Yii::$app->urlManager->createUrl('adress/street?id=') . '"+$(this).val(), function( data ) {
				  $( "select#street" ).html( data );
				});
			'],
            ); ?>
        <?= $form->field($model, 'adressId')
            ->dropDownList(
                [],
                ['id' => 'street', 'prompt' => '-Izaberite ulicu-'],
            ); ?>

        <?= $form->field($model, 'streetNumber') ?>

        <div class="form-group d-flex flex-column">
            <?= Html::submitButton('Registruj se', ['class' => 'mt-3 mb-2 btn btn-danger', 'name' => 'login-button'],) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
