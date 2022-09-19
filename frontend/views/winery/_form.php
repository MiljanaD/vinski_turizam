<?php

use common\models\City;
use common\models\Municipality;
use common\models\Street;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Winery */
/* @var $form yii\widgets\ActiveForm */
/* @var $update boolean */


if($update)
{
    $services = ArrayHelper::map(\common\models\WineryService::find()->where(['winery_id' => $model->id])->all(), 'service_id','service_id');
    foreach ($services as $service)
    {
        $model->services[] = $service;
    }
}

$servicesArray = ArrayHelper::map(\common\models\VineService::find()->all(), 'id', 'name');
$cities = ArrayHelper::map(City::find()->asArray()->all(), 'id', 'name');
$users = ArrayHelper::map(User::find()->select(['id', 'CONCAT(name," ",surname) as full_name'])->asArray()->all(), 'id', 'full_name');

if ($update) {
    $contact = \common\models\Contact::find()->where(['winery' => $model->id])->one();
    foreach ($contact->attributes as $key => $attribute) {
        switch ($key) {
            case 'email':
                if($contact->email != NULL)
                {
                    $model->contact = 'email';
                    $model->contactInfo = $attribute;
                }
                break;
            case 'web_site':
                if($contact->web_site != NULL)
                {
                    $model->contact = 'web_site';
                    $model->contactInfo = $attribute;
                }
                break;
            case 'phone':
                if($contact->phone != NULL)
                {
                    $model->contact = 'phone';
                    $model->contactInfo = $attribute;
                }
                break;
            case 'social_media':
                if($contact->social_media != NULL)
                {
                    $model->contact = 'social_media';
                    $model->contactInfo = $attribute;
                }
                break;
        }
    }
    $model->owner = \common\models\Owner::findOne(['id' => $model->owner])->user_id;
    $street = Street::findOne($model->street);
    $municipality = Municipality::findOne($street->municipality_id);
    $model->municipality = $municipality->id;
    $model->city = City::findOne($municipality->city_id)->id;
}
$this->registerJs("
    $('#city-update-winery').on('click', function() {
        $('#municipality-update-winery').attr('disabled', false);
    });
    $('#municipality-update-winery').on('click', function() {
        $('#street-update-winery').attr('disabled', false);
    })
")
?>

<div class="winery-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="d-flex justify-content-center ">
        <div class="col-5 me-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'owner')->dropDownList($users, [
                'prompt' => '-Izaberite vlasnika-'
            ]) ?>

            <?= $form->field($model, 'contact')->dropDownList([
                'email' => 'email',
                'web_site' => 'website',
                'phone' => 'telefon',
                'social_media' => 'drustvena mreza'
            ], [
                'prompt' => '-Izaberite kontakt-'
            ]) ?>

            <?= $form->field($model, 'contactInfo')->textInput()->label('Kontakt'); ?>

            <?= $form->field($model, 'services')->checkboxList($servicesArray,
                [
                    'multiple' => 'multiple',
                    'class' => ' mb-2'

                ]); ?>
        </div>
        <div class="col-5">
            <?= $form->field($model, 'GPS_coordinates')->textInput(['maxlength' => true]) ?>
            <?php if (!$update) : ?>
                <?= $form->field(new City(), 'name')->dropDownList($cities,
                    ['prompt' => '-Izaberite grad-',
                        'onchange' => '
				$.post( "' . Yii::$app->urlManager->createUrl('adress/municipality?id=') . '"+$(this).val(), function( data ) {
				  $( "select#municipality-winery" ).append( data );
				});
			']) ?>
                <?= $form->field(new Municipality(), 'name')
                    ->dropDownList(
                        [],
                        ['id' => 'municipality-winery', 'prompt' => '-Izaberite opstinu-',
                            'onchange' => '
				$.post( "' . Yii::$app->urlManager->createUrl('adress/street?id=') . '"+$(this).val(), function( data ) {
				  $( "select#street-winery" ).append( data );
				});
			'],
                    ); ?>
                <?= $form->field(new Street(), 'name')
                    ->dropDownList(
                        [],
                        ['id' => 'street-winery', 'prompt' => '-Izaberite ulicu-'],
                    ); ?>

            <?php else: ?>
                <?= $form->field($model, 'city')->dropDownList($cities,
                    ['id' => 'city-update', 'prompt' => '-Izaberite grad-',
                        'onclick' => '
				$.post( "' . Yii::$app->urlManager->createUrl('adress/municipality?id=') . '"+$(this).val(), function( data ) {
				  $( "select#municipality-update-winery" ).html( data );
				});
			']) ?>
                <?php
                    $municipalityList = ArrayHelper::map(Municipality::find()->where(['city_id' => $model->city])->all(), 'id', 'name');
                ?>
                <?= $form->field($model, 'municipality')->dropDownList(
                   $municipalityList,
                    ['id' => 'municipality-update-winery', 'prompt' => '-Izaberite opstinu-',
                        'onclick' => '
            $.post( "' . Yii::$app->urlManager->createUrl('adress/street?id=') . '"+$(this).val(), function( data ) {
            $( "select#street-update-winery" ).html( data );
            });
            '],
                ); ?>
                <?php
                $streetList = ArrayHelper::map(Street::find()->where(['municipality_id' => $model->municipality])->all(), 'id', 'name');
                ?>
                <?= $form->field($model, 'street')->dropDownList(
                    $streetList,
                    ['id' => 'street-update-winery'],
                ); ?>
            <?php endif; ?>

            <?= $form->field($model, 'images[]')->fileInput(['multiple' => true]); ?>
            <div class="d-flex justify-content-center">
                <?= Html::submitButton('Save', ['class' => 'mt-4 w-50 btn-submit-vinskit btn btn-success']) ?>
            </div>


        </div>

        <?php ActiveForm::end(); ?>

    </div>