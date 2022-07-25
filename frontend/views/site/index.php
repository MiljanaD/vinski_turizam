<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $regions yii\web\View */
/* @var $wineries yii\web\View */

\yii\web\YiiAsset::register($this);


$regionsArray = [];
foreach ($regions as $region) {
    $regionsArray[] = $region->attributes;
}

$wineriesArray = [];
foreach ($wineries as $winery) {
    $wineriesArray[] = $winery->attributes;
}

$regionsArray = json_encode($regionsArray);
$wineriesArray = json_encode($wineriesArray);

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">var triangleCoords = [];
    const regions = <?= $regionsArray ?>;
    regions.forEach((model) => {
        // Define the LatLng coordinates for the polygon's path.
        model['GPS_coordinates'] = JSON.parse(model['GPS_coordinates']);
        triangleCoords.push([
            {lat: model['GPS_coordinates'][0][0], lng: model['GPS_coordinates'][0][1]},
            {lat: model['GPS_coordinates'][1][0], lng: model['GPS_coordinates'][1][1]},
            {lat: model['GPS_coordinates'][2][0], lng: model['GPS_coordinates'][2][1]},
        ]);
    });
    window.initMap = function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: 43.507575, lng: 17.833605},
            mapTypeId: 'terrain'
        });
        const winaries = <?= $wineriesArray ?>;
        winaries.forEach((model) => {
            model['GPS_coordinates'] = JSON.parse(model['GPS_coordinates']);
            const coordinate = {lat: model['GPS_coordinates'][0], lng: model['GPS_coordinates'][1]};
            const marker = new google.maps.Marker({
                position: coordinate,
                map: map,
            });
        });
        const bermudaTriangle = new google.maps.Polygon({
            paths: triangleCoords,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
        });
        bermudaTriangle.setMap(map);
    };
    $(document).ready(function () {
        initMap();
        $('#btn-search').click(function () {
            var url = window.location.href;
            var val = $('#search').val();
            $.pjax.reload({container: '#site-pjax', async: false,  type: 'POST', data: {val: val}, url: url });
             $.post( "/site/index", { val: val } ).done(function( data ) {

             });
        })
    });
</script>
<div class="vine-region-view">

    <div class="input-group mb-4">
        <div class="form-outline">
            <input type="search" id="search" class="form-control"/>
        </div>
        <button type="button" id="btn-search" class="btn btn-danger">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <?php Pjax::begin(['id' => 'site-pjax']); ?>

    <div id="map" class="site-map"></div>

    <?php \yii\widgets\Pjax::end(); ?>
</div>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOg5AFknpTC8l9T_03kMgkEso8n5tW8VQ&callback=initMap"
        defer
></script>