<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Winery */
/* @var $update boolean */

?>
<div class="winery-create">

    <?= $this->render('_form', [
        'model' => $model,
        'update' => $update
    ]) ?>

</div>