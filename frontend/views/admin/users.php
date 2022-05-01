<?php

/**
 * @var $dataProvider
 * @var $searchModel
 */

use yii\bootstrap5\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

?>

<div class="container h-100">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            'surname',
            'email',
            [
                'class' => ActionColumn::class,
                'header' => 'Actions',
                'headerOptions' => ['class' => 'header-row text-uppercase'],
                'template' => '{activate}{update}',
                'visibleButtons' => [
                    'update' => true,
                    'activate' => true
                ],
                'buttons' => [
                    'activate' => function ($url, $model) {
                        $url = Url::to(['account/reset-codes', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-check-circle' style='color: #572532'></i>", 'JavaScript:void(0)', [
                            'data-href' => $url,
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
//                            'data-confirm-msg' => 'You will not be able to revert this action. Are you sure you want to reset the Two-Factor Authentication codes for this user?',
//                            'data-confirm-type' => 'danger',
//                            'data-yes' => 'Yes, Reset',
//                            'data-type' => 'post',
//                            'data-toggle' => 'tooltip',
//                            'data-tooltip-container' => 'div',
//                            'data-placement' => 'bottom'
                        ]);
                    },
                    'update' => function ($url, $model) {
                        if ($model['id']) {
                            $url = Url::to(["permission/update", 'id' => $model['id']]);
                        } else {
                            $url = Url::to(["permission/create", 'teacher' => $model['teacher']]);
                        }
                        return Html::a("<i class='fal fa-edit'></i>", 'JavaScript:void(0)', [
                            'data-href' => $url,
                            'class' => 'text-secondary btn-slide-out-modal-control',
                            'title' => 'Edit',
                            'data-toggle' => 'tooltip',
                            'data-tooltip-container' => 'div',
                            'data-placement' => 'bottom',
                            'data-size' => 'modal-lg'
                        ]);
                    },
                ],
            ],
        ],
        'headerRowOptions' => ['class' => 'header-row text-uppercase'],
        'options' => ['class' => 'h-100'],
        'rowOptions' => ['class' => 'table-row'],
    ]); ?>
</div>