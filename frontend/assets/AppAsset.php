<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'dist/sweetalert2.css'
    ];
    public $js = [
        'js/main.js',
        'dist/sweetalert2.all.js'
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\CdnFreeAssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
