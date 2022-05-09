<?php

use common\models\City;
use common\models\Municipality;
use common\models\Street;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$cities = ArrayHelper::map(City::find()->asArray()->all(), 'id', 'name');
$roles = ArrayHelper::map(\common\models\Roles::find()->all(), 'id', 'role');
$street = Street::findOne($model->street);
$model->municipality = Municipality::findOne($street->municipality_id)->id;
$model->city = City::findOne($model->municipality)->id;

$this->registerJs("
    $('#city-update').on('click', function() {
        $('#municipality-update').attr('disabled', false);
    });
    $('#municipality-update').on('click', function() {
        $('#street-update').attr('disabled', false);
    })
")
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

            <?= $form->field($model, 'role')->dropDownList(
                $roles
            ); ?>
        </div>
        <div class="col-5">
            <?= $form->field($model, 'city')->dropDownList($cities,
                ['id' => 'city-update', 'prompt' => '-Izaberite grad-',
                    'onclick' => '
				$.post( "' . Yii::$app->urlManager->createUrl('adress/municipality?id=') . '"+$(this).val(), function( data ) {
				  $( "select#municipality-update" ).html( data );
				});
			']) ?>

            <?= $form->field($model, 'municipality')->dropDownList(
                [$model->municipality => Municipality::findOne($model->municipality)->name],
                ['id' => 'municipality-update', 'prompt' => '-Izaberite opstinu-',
                    'onclick' => '
            $.post( "' . Yii::$app->urlManager->createUrl('adress/street?id=') . '"+$(this).val(), function( data ) {
            console.log(data);
            $( "select#street-update" ).html( data );
            });
            ', 'disabled' => true],
            ); ?>

            <?= $form->field($model, 'street')->dropDownList(
                [$model->street => \common\models\Street::findOne($model->street)->name],
                ['id' => 'street-update', 'disabled' => true],
            ); ?>

            <?= $form->field($model, 'street_number')->textInput() ?>

            <?= $form->field($model, 'activated')->dropDownList(
                ['1' => 'Da',
                    '0' => 'Ne']
            ); ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'mt-4 w-100 btn-submit-vinskit btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>