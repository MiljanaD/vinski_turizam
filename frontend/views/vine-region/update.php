<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VineRegion */

$this->title = 'Update Vine Region: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vine Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vine-region-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>