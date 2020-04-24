<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class WorkFlowAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/toolbox.css',
        'css/app.css',
    ];
    public $js = [
        'js/d3.js',
        'js/FileSaver.min.js',
        'js/drawingpage/bpmnuploader.js',
        'js/drawingpage/devider.js',
        'js/drawingpage/bpmnJsonUpdater.js',
        'js/drawingpage/startevent/startevent.js',
        'js/drawingpage/gateway/gateway.js',
        'js/drawingpage/task/task.js',
        'js/drawingpage/flow/flow.js',
        'js/drawingpage/endevent/endevent.js',
        'js/drawingpage/drawing.js',
        'js/workflow.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
