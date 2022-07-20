<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VineRegion */

$this->title = 'Izmjena podataka vinskog regiona: ' . $model->name;

?>
<div class="vine-region-update">

    <?= $this->render('_form', [
        'model' => $model,
        'update' => true
    ]) ?>

</div>