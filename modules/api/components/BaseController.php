<?php

namespace app\modules\api\components;

use Yii;
use yii\rest\Controller;

class BaseController extends Controller
{

    /**
     * Api Validate error response
     */
    public function apiValidate($strErrors, $strMessage = false)
    {
        Yii::$app->response->statusCode = 422;
        return [
            'statusCode' => 422,
            'name' => 'ValidateErrorException',
            'message' => $strMessage ? $strMessage : 'Error validation',
            'errors' => $strErrors
        ];
    }

    /**
     * Api Created response
     */
    public function apiCreated($data, $strMessage = false, $status, $substatus_code)
    {
        Yii::$app->response->statusCode = 201;
        return [
            'status_code' => $status,
            'sub_status_code' => $substatus_code,
            'message' => $strMessage ? $strMessage : 'Created successfully',
            'data' => $data
        ];
    }

    /**
     * Api Updated response
     */
    public function apiUpdated($data, $strMessage = false)
    {
        Yii::$app->response->statusCode = 202;
        return [
            'statusCode' => 202,
            'message' => $strMessage ? $strMessage : 'Updated successfully',
            'data' => $data
        ];
    }

    /**
     * Api Deleted response
     */
    public function apiDeleted($data, $strMessage = false)
    {
        Yii::$app->response->statusCode = 202;
        return [
            'statusCode' => 202,
            'message' => $strMessage ? $strMessage : 'Deleted successfully',
            'data' => $data
        ];
    }

    /**
     * Api Item response
     */
    public function apiItem($data, $strMessage = false)
    {
        Yii::$app->response->statusCode = 200;
        return [
            'statusCode' => 200,
            'message' => $strMessage ? $strMessage : 'Data retrieval successfully',
            'data' => $data
        ];
    }

    /**
     * Api Collection response
     */
    public function apiCollection($data, $total = 0, $strMessage = false)
    {
        Yii::$app->response->statusCode = 200;
        return [
            'statusCode' => 200,
            'message' => $strMessage ? $strMessage : 'Data retrieval successfully',
            'data' => $data,
            'total' => 0
        ];
    }

    /**
     * Api Success response
     */
    public function apiSuccess($strMessage = false)
    {
        Yii::$app->response->statusCode = 200;
        return [
            'statusCode' => 200,
            'message' => $strMessage ? $strMessage : 'Success',
        ];
    }

    
    /**
     * Api response
     */
    public function apiResponse($strStatusCode,  $data = [], $strMessage = '', $error = '')
    {
        // Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = $strStatusCode;
        $return_arr = [
            'status_code' => $strStatusCode,
        ];
        if (!empty($strMessage)) {
            if (is_array($strMessage)) {
                $strMessage = implode(", ", $strMessage);
            }
            $return_arr['message'] = ucwords($strMessage);
        }
        if (!empty($error)) {
            if (is_array($error)) {
                $error = implode(", ", $error);
            }
            $return_arr['error'] = ucwords($error);
        }
        $return_arr['data'] = $data;
        return $return_arr;
    }
}
