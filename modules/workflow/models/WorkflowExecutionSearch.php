<?php

namespace app\modules\workflow\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\workflow\models\WorkflowExecution;
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
        $tblWorkflowExecution = 'tbl_workflow_execution';
        $tblWorkflow = 'tbl_workflow';
        $query = WorkflowExecution::find()
                    ->select([
                                $tblWorkflowExecution.'.id',
                                $tblWorkflowExecution.'.instance_id',
                                $tblWorkflowExecution.'.request_params',
                                $tblWorkflowExecution.'.response_params',
                                $tblWorkflowExecution.'.execution_id',
                                $tblWorkflowExecution.'.created_at',
                                $tblWorkflow.'.workflow_title as workflow_title',
                                $tblWorkflow.'.workflow_description as workflow_description',
                            ])
                        ->join('inner join', $tblWorkflow, $tblWorkflowExecution.'.instance_id = '. $tblWorkflow .'.id')

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
            $tblWorkflow.'.workflow_title' => $this->workflow_title,
            $tblWorkflow.'.workflow_description' => $this->workflow_description,
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
