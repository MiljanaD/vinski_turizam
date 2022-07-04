<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VineSort */

$this->title = 'Create Vine Sort';
$this->params['breadcrumbs'][] = ['label' => 'Vine Sorts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vine-sort-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
