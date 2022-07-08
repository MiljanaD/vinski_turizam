<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Winery */

$this->title = 'Create Winery';
$this->params['breadcrumbs'][] = ['label' => 'Wineries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="winery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
