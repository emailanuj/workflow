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
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/inspire/css/bootstrap.min.css',
        'themes/inspire/font-awesome/css/font-awesome.min.css',
        'themes/inspire/css/animate.css',
        'themes/inspire/css/style.css',
    ];
    public $js = [
        // 'themes/inspire/js/popper.min.js',
        // 'themes/inspire/js/bootstrap.js',
        // 'themes/inspire/js/inspinia.js',
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
