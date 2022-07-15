<?php

namespace frontend\models;

use common\models\Owner;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Winery;
use Yii;

/**
 * SearchWinery represents the model behind the search form of `common\models\Winery`.
 */
class SearchWinery extends Winery
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'street', 'owner'], 'integer'],
            [['name', 'GPS_coordinates', 'description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Winery::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $userId = \Yii::$app->user->identity->getId();
        if(!Yii::$app->session->get('admin'))
        {
            $owner_id= Owner::find()->where(['user_id' => $userId])->one()->id;
            $query->andFilterWhere([
                'owner' => $owner_id
            ]);
        }
        else
        {
            $query->andFilterWhere([
                'owner' => $this->owner
            ]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'street' => $this->street
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'GPS_coordinates', $this->GPS_coordinates])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
