<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VineRegion */

$this->title = 'Create Vine Region';
$this->params['breadcrumbs'][] = ['label' => 'Vine Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vine-region-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
