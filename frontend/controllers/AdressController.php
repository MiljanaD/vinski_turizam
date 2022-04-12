<?php

namespace frontend\controllers;

use common\models\Municipality;
use common\models\Street;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdressController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['municipality'],
                'rules' => [
                    [
                        'actions' => ['municipality'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ]
            ]
        ];
    }

    public function actionMunicipality($id) {
        $municipalities = Municipality::find()->where(['city_id' => $id])->all();
        if (!empty($municipalities)) {
            foreach($municipalities as $municipality) {
                echo "<option value='".$municipality->id."'>".$municipality->name."</option>";
            }
        } else {
            echo "<option>-Izaberite opstinu-</option>";
        }

    }

    public function actionStreet($id) {
        $streets = Street::find()->where(['municipality_id' => $id])->all();
        if (!empty($streets)) {
            foreach($streets as $street) {
                echo "<option value='".$street->id."'>".$street->name."</option>";
            }
        } else {
            echo "<option>-Izaberite ulicu-</option>";
        }

    }
}