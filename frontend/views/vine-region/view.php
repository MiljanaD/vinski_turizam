<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\VineRegion */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);

$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyDOg5AFknpTC8l9T_03kMgkEso8n5tW8VQ&callback=initMap', ['position' => \yii\web\View::POS_END]);
$this->registerJs("
var x_coordinates = [];
var y_coordinates = [];
$model->GPS_coordinates.forEach((coordinate) => {
    x_coordinates.push(coordinate[0]);
    y_coordinates.push(coordinate[1]);
});
var x_min = Math.min.apply(Math,x_coordinates);
var x_max = Math.max.apply(Math,x_coordinates);

var y_min = Math.min.apply(Math,y_coordinates);
var y_max = Math.max.apply(Math,y_coordinates);

var x_center = x_min + ((x_max - x_min) / 2);
var y_center = y_min + ((y_max - y_min) / 2);
window.initMap = function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: { lat: x_center, lng: y_center },
        mapTypeId: 'terrain'
    });
    // Define the LatLng coordinates for the polygon's path.
    const triangleCoords = [
        { lat: $model->GPS_coordinates[0][0], lng: $model->GPS_coordinates[0][1] },
        { lat: $model->GPS_coordinates[1][0], lng: $model->GPS_coordinates[1][1] },
        { lat: $model->GPS_coordinates[2][0], lng: $model->GPS_coordinates[2][1] },
    ];
    // Construct the polygon.
    const bermudaTriangle = new google.maps.Polygon({
        paths: triangleCoords,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35,
    });

    bermudaTriangle.setMap(map);
}

$( document ).ready(function() {
initMap();              
});
");
//$this->registerJsFile('@web/js/google-map.js');


?>
<div class="vine-region-view">
    <?php Pjax::begin(); ?>
    <h3 class="text-uppercase text-center"> <?=$model->name ?></h3>

    <div id="map" class="vine-region-map"></div>
    <?php \yii\widgets\Pjax::end(); ?>
</div>