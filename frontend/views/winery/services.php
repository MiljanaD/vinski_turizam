<?php
/* @var $model common\models\VineRegion */


use yii\helpers\ArrayHelper;

$services = [];
$wineryServices = ArrayHelper::map(\common\models\WineryService::find()->where(['winery_id' => $model->id])->all(), 'service_id','service_id');
foreach ($wineryServices as $service)
{
    $serviceModel = \common\models\VineService::find()->where(['id' => $service])->one();
    $arrayHelper = [];
    $arrayHelper['id']= $serviceModel->id;
    $arrayHelper['name'] =$serviceModel->name;
    $services[] = $arrayHelper;
}
?>
<div class="container w-50">
<ul class="list-group list-group-flush">
    <?php foreach ($services as $service): ?>
        <li class="list-group-item list-group-item-success text-center openVineSortModal"><?= $service['name'] ?></li>
    <?php endforeach; ?>
</ul>
</div>
