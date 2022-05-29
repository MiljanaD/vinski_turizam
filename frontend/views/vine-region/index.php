<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SearchVineRegion */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vinski regioni';
$regions = \common\models\VineRegion::find()->all();
;
foreach ($regions as $region) {
    ?>

    <?php
}
$urlCreate = Url::to(['vine-region/create']);
?>


<div class="vine-region-index">


        <h1 class="text-uppercase" style="color: white"><?= Html::encode($this->title) ?></h1>
    <div class="d-flex justify-content-end">
        <p>
            <?= Html::a('Kreiraj novi region', 'JavaScript:void(0)', [
                'value' => $urlCreate,
                'title' => 'Kreiranje novog vinskog regiona' ,
                'class' => 'me-2 openVineRegionModal btn btn-danger'
            ]) ?>
        </p>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
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
                        $url = Url::to(['vine-region/delete', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-trash-alt' style='color: #572532'></i>", $url, [
                            'data' => [
                                'href' => $url,
                                'confirm' => 'Da li zelite da obrisete vinski region '. $model->name .'?',
                                'method' => 'post',
                            ],
                            'class' => 'me-2'
                        ]);
                    },
                    'update' => function ($url, $model) {
                        $url = Url::to(['vine-region/update', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-edit' style='color: #572532'></i>", 'JavaScript:void(0)', [
                            'value' => $url,
                            'title' => 'Izmjena podataka vinskog regiona'.' '.$model->name ,
                            'class' => 'me-2 openVineRegionModal'
                        ]);
                    },
                    'view' => function ($url, $model) {
                        $url = Url::to(['vine-region/view', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-eye' style='color: #572532'></i>", 'JavaScript:void(0)', [
                            'value' => $url,
                            'title' => 'Pregled podataka vinskog regiona: '.' '.$model->name,
                            'class' => 'me-2 openVineRegionModal'
                        ]);
                    },
                ]
            ],
        ],
        'headerRowOptions' => ['class' => 'header-row text-uppercase'],
        'options' => ['class' => 'h-100'],
        'rowOptions' => ['class' => 'table-row'],
        'layout' => '{items}{pager}'
    ]); ?>

</div>

<?php

Modal::begin(['id' => 'vine-region-grid-modal', 'title' => 'Registracija', 'titleOptions' => ['class' => 'blackText text-center w-100']]); ?>
    <div class="loader"></div>
<?php Modal::end();

?>