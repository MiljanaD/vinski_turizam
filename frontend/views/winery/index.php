<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SearchWinery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vinarije';

$urlCreate = Url::to(['winery/create']);
?>
<div class="winery-index">

    <h1 class="text-uppercase" style="color: white"><?= Html::encode($this->title) ?></h1>

    <div class="d-flex justify-content-end">
        <p>
            <?= Html::a('Kreiraj novu vinariju', 'JavaScript:void(0)', [
                'value' => $urlCreate,
                'title' => 'Kreiranje nove vinarije' ,
                'class' => 'me-2 openWineryModal btn btn-danger'
            ]) ?>
        </p>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'description',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'header' => 'Akcije',
                'headerOptions' => ['class' => 'header-row text-uppercase'],
                'template' => '{view}{update}{delete}{gallery}{services}',
                'buttonOptions' => ['class' => 'me-2'],
                'visibleButtons' => [
                    'update' => true,
                    'delete' => true,
                    'gallery' => true,
                    'services' => true
                ],
                'buttons' => [
                    'delete' => function ($url, $model) {
                        $url = Url::to(['winery/delete', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-trash-alt' style='color: #572532'></i>", $url, [
                            'data' => [
                                'href' => $url,
                                'confirm' => 'Da li zelite da obrisete vinariju:  '. $model->name .'?',
                                'method' => 'post',
                            ],
                            'class' => 'me-2'
                        ]);
                    },
                    'update' => function ($url, $model) {
                        $url = Url::to(['winery/update', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-edit' style='color: #572532'></i>", 'JavaScript:void(0)', [
                            'value' => $url,
                            'title' => 'Izmjena podataka vinarije: '.' '.$model->name ,
                            'class' => 'me-2 openWineryModal'
                        ]);
                    },
                    'view' => function ($url, $model) {
                        $url = Url::to(['winery/view', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-eye' style='color: #572532'></i>", 'JavaScript:void(0)', [
                            'value' => $url,
                            'title' => 'Pregled podataka vinarije: '.' '.$model->name,
                            'class' => 'me-2 openWineryModal'
                        ]);
                    },
                    'gallery' => function ($url, $model) {
                        $url = Url::to(['winery/gallery', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-images' style='color: #572532'></i>", 'JavaScript:void(0)', [
                            'value' => $url,
                            'title' => 'Galerija vinarije: '.' '.$model->name,
                            'class' => 'me-2 openWineryModal'
                        ]);
                    },
                    'services' => function ($url, $model) {
                        $url = Url::to(['winery/services', 'id' => $model['id']]);
                        return Html::a("<i class='fas fa-wine-glass-alt' style='color: #572532'></i>", 'JavaScript:void(0)', [
                            'value' => $url,
                            'title' => 'Usluge vinarije: '.' '.$model->name,
                            'class' => 'me-2 openWineryModal'
                        ]);
                    },
                ]
            ]
        ],
        'headerRowOptions' => ['class' => 'header-row text-uppercase'],
        'options' => ['class' => 'h-100'],
        'rowOptions' => ['class' => 'table-row'],
        'layout' => '{items}{pager}'
    ]); ?>


</div>

<?php

Modal::begin(['id' => 'winery-grid-modal', 'title' => 'Registracija', 'titleOptions' => ['class' => 'blackText text-center w-100']]); ?>
    <div class="loader"></div>
<?php Modal::end();

?>