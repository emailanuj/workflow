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
        'themes/inspire/css/bootstrap.min.css',
        'themes/inspire/font-awesome/css/font-awesome.min.css',
        'themes/inspire/css/animate.css',
        'themes/inspire/css/style.css',

        'css/toolbox.css',
        // 'css/app.css',
        'css/workflow.css',
        // 'font-awesome/css/font-awesome.min.css',
        'css/custom-style.css',    
    ];
    public $js = [
        'themes/inspire/js/popper.min.js',
        'themes/inspire/js/bootstrap.js',
        'themes/inspire/js/plugins/metisMenu/jquery.metisMenu.js',
        'themes/inspire/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'themes/inspire/js/plugins/flot/jquery.flot.js',
        'themes/inspire/js/plugins/flot/jquery.flot.tooltip.min.js',
        'themes/inspire/js/plugins/flot/jquery.flot.spline.js',
        'themes/inspire/js/plugins/flot/jquery.flot.resize.js',
        'themes/inspire/js/plugins/flot/jquery.flot.pie.js',
        'themes/inspire/js/plugins/flot/jquery.flot.symbol.js',
        'themes/inspire/js/plugins/flot/jquery.flot.time.js',
        'themes/inspire/js/plugins/peity/jquery.peity.min.js',
        'themes/inspire/js/demo/peity-demo.js',
        'themes/inspire/js/inspinia.js',
        'themes/inspire/js/plugins/pace/pace.min.js',
        'themes/inspire/js/plugins/jquery-ui/jquery-ui.min.js',
        'themes/inspire/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js',
        'themes/inspire/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'themes/inspire/js/plugins/easypiechart/jquery.easypiechart.js',
        'themes/inspire/js/plugins/sparkline/jquery.sparkline.min.js',
        'themes/inspire/js/demo/sparkline-demo.js',
        
        'js/d3.js',
        'js/FileSaver.min.js',
        'js/drawingpage/bpmnuploader.js',
        'js/drawingpage/devider.js',
        'js/drawingpage/bpmnJsonUpdater.js',
        'js/drawingpage/startevent/startevent.js',
        'js/drawingpage/gateway/gateway.js',
        'js/drawingpage/task/task.js',
        'js/drawingpage/datastore/datastore.js',
        'js/drawingpage/flow/flow.js',
        'js/drawingpage/endevent/endevent.js',
        'js/drawingpage/drawing.js',
        'js/workflow.js',
        'js/jquery.validate.min.js',
        'js/form-validation.js',        
        // 'js/adminlte.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'fedemotta\datatables\DataTablesAsset',
    ];
}
