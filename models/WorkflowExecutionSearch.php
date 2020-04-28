<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WorkflowExecution;

/**
 * WorkflowExecutionSearch represents the model behind the search form of `app\models\WorkflowExecution`.
 */
class WorkflowExecutionSearch extends WorkflowExecution
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'instance_id', 'executed_at', 'executed_by', 'status'], 'integer'],
            [['request_params', 'response_params'], 'safe'],
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
        $query = WorkflowExecution::find();

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
            'instance_id' => $this->instance_id,
            'executed_at' => $this->executed_at,
            'executed_by' => $this->executed_by,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'request_params', $this->request_params])
            ->andFilterWhere(['like', 'response_params', $this->response_params]);

        return $dataProvider;
    }
}
