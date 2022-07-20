<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region_sort".
 *
 * @property int $id
 * @property int $region_id
 * @property int $sort_id
 *
 * @property VineRegion $region
 * @property VineSort $sort
 */
class RegionSort extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region_sort';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'sort_id'], 'required'],
            [['region_id', 'sort_id'], 'integer'],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => VineRegion::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['sort_id'], 'exist', 'skipOnError' => true, 'targetClass' => VineSort::className(), 'targetAttribute' => ['sort_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region ID',
            'sort_id' => 'Sort ID',
        ];
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(VineRegion::className(), ['id' => 'region_id']);
    }

    /**
     * Gets query for [[Sort]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSort()
    {
        return $this->hasOne(VineSort::className(), ['id' => 'sort_id']);
    }
}
