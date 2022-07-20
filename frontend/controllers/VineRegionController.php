<?php

namespace frontend\controllers;

use common\models\RegionSort;
use common\models\VineRegion;
use common\models\VineSort;
use frontend\models\SearchVineRegion;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * VineRegionController implements the CRUD actions for VineRegion model.
 */
class VineRegionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new SearchVineRegion();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]);
        }
        return $this->goHome();
    }

    public function actionCreate()
    {
        $model = new VineRegion();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                foreach ($model->vineSort as $sort)
                {
                    $regionSort = new RegionSort();
                    $regionSort->sort_id = $sort;
                    $regionSort->region_id = $model->id;
                    $regionSort->save();
                }
                return $this->redirect(['index']);
            }
            else {
                $model->loadDefaultValues();
            }

        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
        return $this->goHome();
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                $regionSortArray = RegionSort::find()->where(['region_id' => $model->id])->all();
                foreach ($regionSortArray as $item)
                {
                    $regionSortModel = RegionSort::findOne($item->id);
                    $regionSortModel->delete();
                }
                foreach ($model->vineSort as $sort)
                {
                    $regionSort = new RegionSort();
                    $regionSort->sort_id = $sort;
                    $regionSort->region_id = $model->id;
                    $regionSort->save();
                }
                return $this->redirect(['index']);
            }
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id)
    {
        if (Yii::$app->request->isPost) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } else {
            return $this->goHome();
        }


    }

    /**
     * Finds the VineRegion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return VineRegion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VineRegion::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
