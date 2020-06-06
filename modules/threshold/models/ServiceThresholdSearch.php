<?php

namespace app\modules\threshold\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\threshold\models\ServiceThreshold;

/**
 * ServiceThresholdSearch represents the model behind the search form of `app\models\ServiceThreshold`.
 */
class ServiceThresholdSearch extends ServiceThreshold
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'threshold_for_peak_in_last_15days', 'threshold_for_current_utilisation'], 'integer'],
            [['service_type', 'tags'], 'safe'],
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
        $query = ServiceThreshold::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'threshold_for_peak_in_last_15days' => $this->threshold_for_peak_in_last_15days,
            'threshold_for_current_utilisation' => $this->threshold_for_current_utilisation,
        ]);

        $query->andFilterWhere(['like', 'service_type', $this->service_type])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }
}
