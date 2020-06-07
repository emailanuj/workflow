<?php

namespace app\modules\workflow\models;

use Yii;
use yii\base\Model;

class WorkflowStartEventModel extends Model
{

    public $step_no;
    public $if_fail;
    public $next_process;
    public $api_url;
    public $keywords;
    public $api_method;
    public $api_post_params;
    public $api_type;
    public $api_headers;
    public $data_source;
    public $get_data_function;
    public $function_execute;
    public $auth_type;
    public $token_from;
    public $token_url;
    public $username;
    public $password;
    public $form_data;
    public $form_json;
    public $condition_statement; 
    public $email_from;
    public $email_to;
    public $subject;
    public $message;   
    public $datastore_name;
    public $collection_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['step_no','if_fail'], 'required'],
            [['step_no','if_fail','next_process','keywords','api_url','api_method','api_type','api_headers','function_execute','auth_type'], 'required','on'=>'API'],
            [['step_no','if_fail','next_process','keywords','data_source'], 'required','on'=>'NSO'],
            [['step_no','if_fail','next_process','keywords','data_source'], 'required','on'=>'Postcheck'],
            [['step_no','if_fail','next_process','keywords','data_source'], 'required','on'=>'Precheck'],
            [['step_no','if_fail','condition_statement','next_process'], 'required','on'=>'parallel'],
            [['step_no','if_fail','condition_statement','next_process'], 'required','on'=>'inclusive'],
            [['step_no','if_fail','condition_statement','next_process'], 'required','on'=>'exclusive'],
            [['step_no','if_fail','condition_statement','next_process'], 'required','on'=>'event'],
            [['api_post_params'], 'required', 'on'=>'rest'],
            [['step_no','next_process'], 'number'],
            [['email_from','email_to','subject','message'], 'required','on'=>'MessageStartEvent'],
            [['datastore_name', 'collection_name'], 'required', 'on'=>'datastore']
        ];
    }
    public function scenarios() {
        $scenarios = parent::scenarios();
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'step_no' => 'Step No',
            'if_fail' => 'If Fail',
            'next_process' => 'Next Process',
            'api_url'=>'API URL',
            'keywords'=>'Keyword',
            'api_method'=>'API method',
            'api_post_params' => 'API Post',
            'api_type'=>'API type',
            'api_headers'=>'API headers',
            'data_source'=>'Data Source',
            'get_data_function'=>'Get Data Function',
            'function_execute'=>'Function to execute',
            'auth_type'=>'Auth type',
            'token_from'=>'Token from',
            'token_url'=>'Token URL',
            'username'=>'Username',
            'password'=>'Password',
            'form_data'=>'Form Data',
            'form_json'=>'Form JSON',
            'condition_statement'=>'Conditional Statement',
            'email_from' => 'Email From',
            'email_to'   => 'Email To',
            'subject'=> 'Subject',
            'message' => 'Message',
            'datastore_name' => 'Database Name',
            'collection_name' => 'Collection Name'            
        ];
    }
    
}
