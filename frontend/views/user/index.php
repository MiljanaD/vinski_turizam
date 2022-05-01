<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Korisnici';
?>
<div class="user-index container">

    <h1 class="text-uppercase"><?= Html::encode($this->title) ?></h1>

    <div class="users-grid mt-4">

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
            'columns' => [
                'name',
                'surname',
                'email',
                'activated' => [
                    'label' => 'Activated',
                    'value' => function ($model) {
                        return $model->activated == 1 ? 'Yes' : 'No';
                    }
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'header' => 'Actions',
                    'headerOptions' => ['class' => 'header-row text-uppercase'],
                ],
            ],
            'headerRowOptions' => ['class' => 'header-row text-uppercase'],
            'options' => ['class' => 'h-100'],
            'rowOptions' => ['class' => 'table-row'],
            'layout' => '{items}{pager}'
        ]); ?>

        <?php Pjax::end(); ?>
    </div>

</div>