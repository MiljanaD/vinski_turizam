<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Winery */

$owner = \common\models\Owner::find()->where(['id' => $model->owner])->one();
$user = \common\models\User::find()->where(['id' => $owner->user_id])->one();
$contact = \common\models\Contact::find()->where(['winery' => $model->id])->one();
\yii\web\YiiAsset::register($this);

$images = \common\models\Image::find()->where(['winary' => $model->id])->all();
$model->GPS_coordinates =json_decode($model->GPS_coordinates);
?>
<script type="text/javascript">window.initMap = function initMap() {
        // The location of Uluru
        var lat = <?= $model->GPS_coordinates[0] ?>;
        var lng = <?= $model->GPS_coordinates[1] ?>;
        const uluru = { lat: lat, lng: lng };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            position: uluru,
            map: map,
        });
    }

    $( document ).ready(function() {
        initMap();
    });</script>
<?php Pjax::begin([]) ?>
    <div class="winery-view">
        <?= DetailView::widget([
            'model' => $model,
            'options' => [
                'class' => 'table table-bordered detail-view'
            ],
            'attributes' => [
                'name',
                'description',
            ],
        ]) ?>
        <div id="map" style="height: 300px; width: 100%"></div>
        <div class="text-center">
            <label class="text-uppercase font-weight-bold">vlasnik</label>
            <?= $this->render('//user/view', ['model' => $user]); ?>
        </div>

        <div class="text-center">
            <label class="text-uppercase font-weight-bold">kontakt</label>
            <?= DetailView::widget([
                'options' => [
                    'class' => 'table table-bordered detail-view'
                ],
                'model' => $contact,
                'attributes' => [
                    'email' => [
                        'label' => 'Email',
                        'value' => function ($model) {
                            return $model->email;
                        },
                        'visible' => $contact->email != NULL
                    ],
                    'web_site' => [
                        'label' => 'Web site',
                        'value' => function ($model) {
                            return $model->web_site;
                        },
                        'visible' => $contact->web_site != NULL
                    ],
                    'social_media' => [
                        'label' => 'Drustvena mreza',
                        'value' => function ($model) {
                            return $model->social_media;
                        },
                        'visible' => $contact->social_media != NULL
                    ],
                    'phone' => [
                        'label' => 'Telefon',
                        'value' => function ($model) {
                            return $model->phone;
                        },
                        'visible' => $contact->phone != NULL
                    ],
                ],
            ]) ?>

        </div>
    </div>
<?php Pjax::end() ?>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOg5AFknpTC8l9T_03kMgkEso8n5tW8VQ&callback=initMap"
        defer
></script>
