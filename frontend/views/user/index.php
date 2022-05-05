<?php

use yii\bootstrap5\Modal;
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

        <h1 class="text-uppercase" style="color: white"><?= Html::encode($this->title) ?></h1>

        <div class="users-grid mt-4">

            <?php Pjax::begin(); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                'columns' => [
                    'name' => [
                            'label' => 'Ime',
                        'value' => function ($model) {
                            return $model->name;
                        }
                    ],
                    'surname'  => [
                        'label' => 'Prezime',
                         'value' => function ($model) {
                            return $model->surname;
                        }
                    ],
                    'email',
                    'activated' => [
                        'label' => 'Nalog aktiviran',
                        'value' => function ($model) {
                            return $model->activated == 1 ? 'Da' : 'Ne';
                        }
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'header' => 'Akcije',
                        'headerOptions' => ['class' => 'header-row text-uppercase'],
                        'template' => '{activate}{view}{update}{delete}',
                        'buttonOptions' => ['class' => 'me-2'],
                        'visibleButtons' => [
                            'update' => true,
                            'delete' => true,
                            'view' => true,
                            'activate' => function($model) {
                                return !$model->activated;
                            }
                        ],
                        'buttons' => [
                            'activate' => function ($url, $model) {
                                $url = Url::to(['user/activate-user', 'id' => $model['id']]);
                                return Html::a("<i class='far fa-check-circle' style='color: #572532'></i>", $url, [
                                    'data' => [
                                            'href' => $url,
                                        'confirm' => 'Da li zelite da aktivirate nalog korisnika '. $model->name .' ' .$model->surname .'?',
                                        'method' => 'post',
                                    ],
                                    'class' => 'me-2'
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                $url = Url::to(['user/delete', 'id' => $model['id']]);
                                return Html::a("<i class='far fa-trash-alt' style='color: #572532'></i>", $url, [
                                    'data' => [
                                        'href' => $url,
                                        'confirm' => 'Da li zelite da obrisete nalog korsnika '. $model->name .' ' .$model->surname .'?',
                                        'method' => 'post',
                                    ],
                                    'class' => 'me-2'
                                ]);
                            },
                            'update' => function ($url, $model) {
                                $url = Url::to(['user/update', 'id' => $model['id']]);
                                return Html::a("<i class='far fa-edit' style='color: #572532'></i>", 'JavaScript:void(0)', [
                                    'value' => $url,
                                    'title' => 'Izmjena podataka korisnika'.' '.$model->name. ' '. $model->surname,
                                    'class' => 'me-2 openUserModal'
                                ]);
                            },
                            'view' => function ($url, $model) {
                                $url = Url::to(['user/view', 'id' => $model['id']]);
                                return Html::a("<i class='far fa-eye' style='color: #572532'></i>", 'JavaScript:void(0)', [
                                    'value' => $url,
                                    'title' => 'Pregled podataka korisnika'.' '.$model->name. ' '. $model->surname,
                                    'class' => 'me-2 openUserModal'
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

            <?php Pjax::end(); ?>
        </div>

    </div>
<?php

Modal::begin(['id' => 'user-grid-modal', 'title' => 'Registracija', 'titleOptions' => ['class' => 'blackText text-center w-100']]); ?>
    <div class="loader"></div>
<?php Modal::end();

?>