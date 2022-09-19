<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SearchVineSort */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vinske sorte';
$urlCreate = Url::to(['vine-sort/create']);
?>
<div class="vine-sort-index">

    <h1 class="text-uppercase" style="color: white"><?= Html::encode($this->title) ?></h1>

    <div class="d-flex justify-content-end">
        <p>
            <?= Html::a('Kreiraj novu sortu', 'JavaScript:void(0)', [
                'value' => $urlCreate,
                'title' => 'Kreiranje nove vinske sorte' ,
                'class' => 'me-2 openVineSortModal btn btn-danger'
            ]) ?>
        </p>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'header' => 'Akcije',
                'headerOptions' => ['class' => 'header-row text-uppercase'],
                'template' => '{view}{update}{delete}',
                'buttonOptions' => ['class' => 'me-2'],
                'visibleButtons' => [
                    'update' => true,
                    'delete' => true,
                ],
                'buttons' => [
                    'delete' => function ($url, $model) {
                        $url = Url::to(['vine-sort/delete', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-trash-alt' style='color: #572532'></i>", $url, [
                            'data' => [
                                'href' => $url,
                                'confirm' => 'Da li zelite da obrisete vinsku sortu '. $model->name .'?',
                                'method' => 'post',
                            ],
                            'class' => 'me-2'
                        ]);
                    },
                    'update' => function ($url, $model) {
                        $url = Url::to(['vine-sort/update', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-edit' style='color: #572532'></i>", 'JavaScript:void(0)', [
                            'value' => $url,
                            'title' => 'Izmjena podataka vinske sorte'.' '.$model->name ,
                            'class' => 'me-2 openVineSortModal'
                        ]);
                    },
                    'view' => function ($url, $model) {
                        $url = Url::to(['vine-sort/view', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-eye' style='color: #572532'></i>", 'JavaScript:void(0)', [
                            'value' => $url,
                            'title' => 'Pregled podataka vinske sorte: '.' '.$model->name,
                            'class' => 'me-2 openVineSortModal'
                        ]);
                    },
                ],
                ]
        ],
        'headerRowOptions' => ['class' => 'header-row text-uppercase'],
        'options' => ['class' => 'h-100'],
        'rowOptions' => ['class' => 'table-row'],
        'layout' => '{items}{pager}'
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<?php

Modal::begin(['id' => 'vine-sort-grid-modal', 'title' => 'Vinska sorta', 'titleOptions' => ['class' => 'blackText text-center w-100']]); ?>
    <div class="loader"></div>
<?php Modal::end();

?>