<?php

use yii\bootstrap5\Modal;
use yii\helpers\Url;
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
$url = \yii\helpers\Url::to('vine-region/view', true);

?>
<?php Pjax::begin(['id' => 'site-pjax']); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">var triangleCoords = [];
    window.initMap = function initMap(regions = <?=$regionsArray?>, wineries = <?=$wineriesArray?>) {

        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: 43.507575, lng: 17.833605},
            mapTypeId: 'terrain'
        });
        regions.forEach((model) => {
            // Define the LatLng coordinates for the polygon's path.
            model['GPS_coordinates'] = JSON.parse(model['GPS_coordinates']);
            const coords = [
                {lat: model['GPS_coordinates'][0][0], lng: model['GPS_coordinates'][0][1]},
                {lat: model['GPS_coordinates'][1][0], lng: model['GPS_coordinates'][1][1]},
                {lat: model['GPS_coordinates'][2][0], lng: model['GPS_coordinates'][2][1]},
            ];
            const poly = new google.maps.Polygon({
                paths: coords,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
            });
            google.maps.event.addListener(poly, 'click', function() {
                const id = model['id'];
                $.ajax("/vine-region/view?id="+id).done(function( data ) {
                    $("#site-modal").modal().find(".modal-dialog").addClass('modal-lg');
                    $("#site-modal").modal('show')
                        .find(".modal-body").html(data);
                    $("#site-modal").modal().find(".modal-title")
                        .html("<b>"+model['name'] +"</b>");
                });
            });
            poly.setMap(map);
        });
        wineries.forEach((model) => {
            model['GPS_coordinates'] = JSON.parse(model['GPS_coordinates']);
            const coordinate = {lat: model['GPS_coordinates'][0], lng: model['GPS_coordinates'][1]};
            const marker = new google.maps.Marker({
                position: coordinate,
                map: map,
            });
            google.maps.event.addListener(marker, 'click', function() {
                const id = model['id'];
                $.ajax("/winery/view?id="+id).done(function( data ) {
                    $("#site-modal").modal().find(".modal-dialog").addClass('modal-lg');
                    $("#site-modal").modal('show')
                        .find(".modal-body").html(data);
                    $("#site-modal").modal().find(".modal-title")
                        .html("<b>"+model['name'] +"</b>");
                });
            });
        });
    };
    $(document).ready(function () {
        initMap();
        $('#btn-search-region').click(function () {
            var url = window.location.href;
            var val = $('#search-region').val();
            $.pjax.reload({container: '#site-pjax', async: false, type: 'POST', data: {val: val, target: 'region'}, url: url})
        })
        $('#btn-search-winery').click(function () {
            var url = window.location.href;
            var val = $('#search-winery').val();
            console.log(val);
            $.pjax.reload({container: '#site-pjax', async: false, type: 'POST', data: {val: val, target: 'winery'}, url: url})
        })
    });
</script>
<div class="vine-region-view">
    <div class="d-flex justify-content-start">
        <div>
            <div class="text-uppercase font-weight-bold"> Region - region/sorta</div>
            <div class="input-group mb-4 me-3">
                <div class="form-outline">
                    <input type="search" id="search-region" class="form-control"/>
                </div>
                <button type="button" id="btn-search-region" class="btn btn-danger">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div>
            <div class="text-uppercase font-weight-bold">Vinarija - opstina/usluge</div>
            <div class="input-group mb-4">
                <div class="form-outline">
                    <input type="search" id="search-winery" class="form-control"/>
                </div>
                <button type="button" id="btn-search-winery" class="btn btn-danger">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>


    <div id="map" class="site-map"></div>

    <?php \yii\widgets\Pjax::end(); ?>
</div>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOg5AFknpTC8l9T_03kMgkEso8n5tW8VQ&callback=initMap"
        defer
></script>

<?php

Modal::begin(['id' => 'site-modal', 'title' => 'Detaljne Informacije', 'titleOptions' => ['class' => 'blackText text-center w-100']]); ?>
    <div class="loader"></div>
<?php Modal::end();

?>