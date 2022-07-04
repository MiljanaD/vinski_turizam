<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VineService */

$this->title = 'Update Vine Service: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vine Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vine-service-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>