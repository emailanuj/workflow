<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MongoWorkFlow;

/**
 * MongoWorkflowSearch represents the model behind the search form of `app\models\MongoWorkFlow`.
 */
class MongoWorkflowSearch extends MongoWorkFlow
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'session_id', 'workflow_title', 'workflow_description', 'workflow_data', 'workflow_json', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = MongoWorkFlow::find();

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
        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'session_id', $this->session_id])
            ->andFilterWhere(['like', 'workflow_title', $this->workflow_title])
            ->andFilterWhere(['like', 'workflow_description', $this->workflow_description])
            ->andFilterWhere(['like', 'workflow_data', $this->workflow_data])
            ->andFilterWhere(['like', 'workflow_json', $this->workflow_json])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
