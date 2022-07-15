<?php


/* @var $this yii\web\View */
/* @var $model common\models\Winery */

use yii\helpers\Html;

\yii\web\YiiAsset::register($this);

$images = \common\models\Image::find()->where(['winary' => $model->id])->all();
?>

<div class="d-flex justify-content-center container row">
    <?php foreach ($images as $image): ?>
        <?= Html::img("@web/images/winery-images/$image->name", ['class' => 'col-4 m-2']); ?>
    <?php endforeach; ?>
</div>
