<?php

namespace app\controllers;

use Yii;
use app\models\WorkflowExecution;
use app\models\WorkflowExecutionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkflowExecutionController implements the CRUD actions for WorkflowExecution model.
 */
class WorkflowExecutionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    
}
