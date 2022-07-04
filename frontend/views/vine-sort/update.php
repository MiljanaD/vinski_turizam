<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VineSort */

$this->title = 'Izmjena podatak vinske sorte: ' . $model->name;

?>
<div class="vine-sort-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>