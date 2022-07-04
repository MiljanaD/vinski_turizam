<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\VineSort */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="vine-sort-view">
    <div class="d-flex justify-content-between align-content-center text-center">
        <?= Html::img("@web/images/vine-sort-images/$model->image", ['class' => 'w-50 mb-4']); ?>
        <div class="w-50 d-flex flex-column align-items-center">
            <h3 class="text-uppercase w-50 d-flex text-center align-items-center justify-content-center mb-3"> <?= $model->name ?></h3>
            <?= DetailView::widget([
                'model' => $model,
                'options' => [
                    'class' => 'ms-3 mt-5 table table-bordered detail-view'
                ],
                'attributes' => [
                    'description' => [
                        'label' => 'Kratak opis',
                        'value' => function ($model) {
                            return $model->description;
                        }
                    ],
                    'vine_region' => [
                        'label' => 'Vinski region',
                        'value' => function ($model) {
                            return \common\models\VineRegion::findOne($model->vine_region)->name;;
                        }
                    ],
                ],
            ]) ?>
            <div>
    </div>

</div>