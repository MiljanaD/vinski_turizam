<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SearchVineService */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usluge vinarija';
$urlCreate = Url::to(['vine-service/create']);
?>
<div class="vine-service-index">

    <h1 class="text-uppercase" style="color: white"><?= Html::encode($this->title) ?></h1>

    <div class="d-flex justify-content-end">
        <p>
            <?= Html::a('Kreiraj novu uslugu', 'JavaScript:void(0)', [
                'value' => $urlCreate,
                'title' => 'Kreiranje nove usluge za vinariju' ,
                'class' => 'me-2 openVineServiceModal btn btn-danger'
            ]) ?>
        </p>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'template' => '{view}{update}{delete}',
                'buttonOptions' => ['class' => 'me-2'],
                'visibleButtons' => [
                    'update' => true,
                    'delete' => true,
                ],
                'buttons' => [
                    'delete' => function ($url, $model) {
                        $url = Url::to(['vine-service/delete', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-trash-alt' style='color: #572532'></i>", $url, [
                            'data' => [
                                'href' => $url,
                                'confirm' => 'Da li zelite da obrisete uslugu:  '. $model->name .'?',
                                'method' => 'post',
                            ],
                            'class' => 'me-2'
                        ]);
                    },
                    'update' => function ($url, $model) {
                        $url = Url::to(['vine-service/update', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-edit' style='color: #572532'></i>", 'JavaScript:void(0)', [
                            'value' => $url,
                            'title' => 'Izmjena podataka usluge: '.' '.$model->name ,
                            'class' => 'me-2 openVineServiceModal'
                        ]);
                    },
                    'view' => function ($url, $model) {
                        $url = Url::to(['vine-service/view', 'id' => $model['id']]);
                        return Html::a("<i class='far fa-eye' style='color: #572532'></i>", 'JavaScript:void(0)', [
                            'value' => $url,
                            'title' => 'Pregled podataka usluge: '.' '.$model->name,
                            'class' => 'me-2 openVineServiceModal'
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

    <?php Pjax::end(); ?>

</div>

<?php

Modal::begin(['id' => 'vine-service-grid-modal', 'title' => 'Registracija', 'titleOptions' => ['class' => 'blackText text-center w-100']]); ?>
    <div class="loader"></div>
<?php Modal::end();

?>