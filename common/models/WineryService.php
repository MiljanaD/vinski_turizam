<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "winery_service".
 *
 * @property int $id
 * @property int $winery_id
 * @property int $service_id
 *
 * @property VineService $service
 * @property Winery $winery
 */
class WineryService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'winery_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['winery_id', 'service_id'], 'required'],
            [['winery_id', 'service_id'], 'integer'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => VineService::className(), 'targetAttribute' => ['service_id' => 'id']],
            [['winery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Winery::className(), 'targetAttribute' => ['winery_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'winery_id' => 'Winery ID',
            'service_id' => 'Service ID',
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(VineService::className(), ['id' => 'service_id']);
    }

    /**
     * Gets query for [[Winery]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWinery()
    {
        return $this->hasOne(Winery::className(), ['id' => 'winery_id']);
    }
}
