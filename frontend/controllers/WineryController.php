<?php

namespace frontend\controllers;

use common\models\Contact;
use common\models\Owner;
use common\models\Winery;
use frontend\models\SearchWinery;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * WineryController implements the CRUD actions for Winery model.
 */
class WineryController extends Controller
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

    /**
     * Lists all Winery models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SearchWinery();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Winery model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('view', [
                'model' => $this->findModel($id),
            ]);
        }
        return $this->goHome();
    }


    public function actionGallery($id)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('gallery', [
                'model' => $this->findModel($id),
            ]);
        }
        return $this->goHome();
    }

    /**
     * Creates a new Winery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Winery();

     if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if(!Owner::find()->where(['user_id' => $model->owner])->all()) {
                    $owner = new Owner();
                    $owner->user_id = $model->owner;
                    $owner->type = 'fizicko lice';
                    if ($owner->save()) {
                        $owner->refresh();
                        $model->owner = $owner->id;
                    }
                }
                else
                {
                    $owner = Owner::find()->where(['user_id' => $model->owner])->one();
                    $model->owner = $owner->id;
                }
                $model->street = $this->request->post()['Street']['name'];
                $model->images = UploadedFile::getInstances($model, 'images');
                if ($model->upload()) {
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
                'update' => false
            ]);
        }
        return $this->goHome();
    }

    /**
     * Updates an existing Winery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if(!Owner::find()->where(['user_id' => $model->owner])->all()) {
                    $owner = new Owner();
                    $owner->user_id = $model->owner;
                    $owner->type = 'fizicko lice';
                    if ($owner->save()) {
                        $owner->refresh();
                        $model->owner = $owner->id;
                    }
                }
                else
                {
                    $owner = Owner::find()->where(['user_id' => $model->owner])->one();
                    $model->owner = $owner->id;
                }
                $model->images = UploadedFile::getInstances($model, 'images');
                if ($model->upload()) {
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        } if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
                'update' => true
            ]);
        }
    }

    /**
     * Deletes an existing Winery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
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
     * Finds the Winery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Winery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Winery::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
