<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        "css/bootstrap-utilities.min.css",
        "css/bootstrap.min.css",
        'css/fontawesome.min.css',
        "css/bootstrap-icons/bootstrap-icons.min.css",
        'css/fonts.css',
    ];
    public $js = [
        "js/jquery.min.js",
        "js/helper.js",
        "js/bootstrap.min.js",
        "js/bootstrap.bundle.min.js",
        "js/cautela.js",
        "js/jquery.mask.min.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
