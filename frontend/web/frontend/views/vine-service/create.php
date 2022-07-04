<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VineService */

$this->title = 'Create Vine Service';
$this->params['breadcrumbs'][] = ['label' => 'Vine Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vine-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
