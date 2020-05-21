<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WorkflowExecution;
use yii\behaviors\TimestampBehavior;

/**
 * WorkflowExecutionSearch represents the model behind the search form of `app\models\WorkflowExecution`.
 */
class WorkflowExecutionSearch extends WorkflowExecution
{

    public $workflow_title;
    public $workflow_description;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['instance_id', 'request_params', 'execution_id','api_domain','response_params','executed_by','status','workflow_title','workflow_description'], 'safe'],
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
            'status' => $this->status,
            'executed_by' => $this->executed_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'request_params', $this->request_params])
            ->andFilterWhere(['like', 'response_params', $this->response_params])
            ->andFilterWhere(['like', 'execution_id', $this->execution_id])
            ->andFilterWhere(['like', 'api_domain', $this->api_domain])
            ->andFilterWhere(['like', 'auth_token', $this->auth_token]);



        return $dataProvider;
    }

    public function searchWorkflowReport($params)
    {
        $query = WorkflowExecution::find()
                    ->select([
                                'workflow_execution.id',
                                'workflow_execution.instance_id',
                                'workflow_execution.request_params',
                                'workflow_execution.response_params',
                                'workflow_execution.execution_id',
                                'workflow_execution.created_at',
                                'workflow.workflow_title as workflow_title',
                                'workflow.workflow_description as workflow_description',
                            ])
                        ->join('inner join', 'workflow', 'workflow_execution.instance_id = workflow.id')

                        // ->andWhere('bng_master_label_values.is_active =1');
        ;   


        $query->groupBy(['execution_id']);
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
            'workflow.workflow_title' => $this->workflow_title,
            'workflow.workflow_description' => $this->workflow_description,
            'instance_id' => $this->instance_id,
            'status' => $this->status,
            'executed_by' => $this->executed_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'request_params', $this->request_params])
            ->andFilterWhere(['like', 'response_params', $this->response_params])
            ->andFilterWhere(['like', 'execution_id', $this->execution_id])
            ->andFilterWhere(['like', 'api_domain', $this->api_domain])
            ->andFilterWhere(['like', 'auth_token', $this->auth_token]);



        return $dataProvider;
    }
}
