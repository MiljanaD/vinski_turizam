<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VineSort */

$this->params['breadcrumbs'][] = ['label' => 'Vine Sorts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vine-sort-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>