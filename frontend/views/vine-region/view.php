<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\VineRegion */

$this->title = $model->name;
$this->registerJs("

window.initMap = function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: { lat: 24.886, lng: -70.268 },
        mapTypeId: 'terrain'
    });
    // Define the LatLng coordinates for the polygon's path.
    const triangleCoords = [
        { lat: 25.774, lng: -80.19 },
        { lat: 18.466, lng: -66.118 },
        { lat: 32.321, lng: -64.757 },
        { lat: 25.774, lng: -80.19 },
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

window.initMap = initMap;");
\yii\web\YiiAsset::register($this);
//$this->registerJsFile('@web/js/google-map.js');
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyDOg5AFknpTC8l9T_03kMgkEso8n5tW8VQ&callback=initMap',['async'=>true, 'defer'=>true]);
?>
<div class="vine-region-view">

    <h3 class="text-uppercase text-center"> <?=$model->name ?></h3>

    <div id="map" class="vine-region-map"></div>
</div>