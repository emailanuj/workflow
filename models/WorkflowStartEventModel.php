<?php

namespace app\models;

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
    public $api_type;
    public $api_headers;
    public $datasource;
    public $get_data_function;
    public $function_execute;
    public $auth_type;
    public $token_from;
    public $token_url;
    public $username;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['step_no','if_fail'], 'required'],
            
        ];
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
            'api_type'=>'API type',
            'api_headers'=>'API headers',
            'datasource'=>'Data Source',
            'get_data_function'=>'Get Data Function',
            'function_execute'=>'Function to execute',
            'auth_type'=>'Auth type',
            'token_from'=>'Token from',
            'token_url'=>'Token URL',
            'username'=>'Username',
            'password'=>'Password',
        ];
    }
    
}
