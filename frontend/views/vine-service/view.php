<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\VineService */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="vine-service-view">

    <?= DetailView::widget([
        'model' => $model,
        'options' => [
            'class' => 'table table-bordered detail-view'
        ],
        'attributes' => [
            'name' => [
                    'label' => 'Naziv usluge',
                'value' => function ($model) {
                    return $model->name;
                }
            ],
            'description' => [
                'label' => 'Kratak opis',
                'value' => function ($model) {
                    return $model->description;
                }
            ],
        ],
    ]) ?>

</div>