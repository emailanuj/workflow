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
        'assets/BPNM/public/css/toolbox.css',
        'assets/BPNM/public/css/bootstrap.min.css',
        'assets/BPNM/public/css/app.css',
    ];
    public $js = [
        'assets/BPNM/public/js/d3.js',
        'assets/BPNM/public/js/jquery.min.js',
        'assets/BPNM/public/js/angular.min.js',
        'assets/BPNM/public/js/bootstrap.js',
        'assets/BPNM/public/js/FileSaver.min.js',
        'assets/BPNM/drawingpage/bpmnuploader.js',
        'assets/BPNM/drawingpage/devider.js',
        'assets/BPNM/drawingpage/bpmnJsonUpdater.js',
        'assets/BPNM/drawingpage/startevent/startevent.js',
        'assets/BPNM/drawingpage/gateway/gateway.js',
        'assets/BPNM/drawingpage/task/task.js',
        'assets/BPNM/drawingpage/flow/flow.js',
        'assets/BPNM/drawingpage/endevent/endevent.js',
        'assets/BPNM/drawingpage/drawing.js',
        'assets/BPNM/drawingpage/workflow.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
