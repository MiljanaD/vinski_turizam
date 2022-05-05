<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

\yii\web\YiiAsset::register($this);
?>
<div class="user-view">


    <?= DetailView::widget([
        'model' => $model,
        'options' => [
            'class' => 'table table-bordered detail-view'
        ],
        'attributes' => [
            'name' => [
                'label' => 'Ime',
                'value' => function ($model) {
                    return $model->name;
                }
            ],
            'surname' => [
                'label' => 'Prezime',
                'value' => function ($model) {
                    return $model->surname;
                }
            ],
            'email:email',
            'phone_number' => [
                'label' => 'Broj telefona',
                'value' => function ($model) {
                    return $model->phone_number;
                }
            ],
            'role' => [
                'label' => 'Rola',
                'value' => function ($model) {
                    return \common\models\Roles::findOne($model->role)->role;
                }
            ],
            'street' => [
                'label' => 'Ulica',
                'value' => function ($model) {
                    return \common\models\Street::findOne($model->street)->name . " " . $model->street_number;
                }
            ],
            'municipality' => [
                'label' => 'Opstina',
                'value' => function ($model) {
                    $street = \common\models\Street::findOne($model->street);
                    return \common\models\Municipality::findOne($street->municipality_id)->name;
                }
            ],
            'city' => [
                'label' => 'Grad',
                'value' => function ($model) {
                    $street = \common\models\Street::findOne($model->street);
                    $municipality = \common\models\Municipality::findOne($street->municipality_id);
                    return \common\models\City::findOne($municipality->city_id)->name;
                }
            ],
            'activated' => [
                'label' => 'Nalog aktiviran',
                'value' => function ($model) {
                    return $model->activated == 1 ? 'Da' : 'Ne';
                }
            ],
        ],
    ]) ?>

</div>