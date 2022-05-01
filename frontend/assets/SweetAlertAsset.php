<?php

namespace frontend\assets;

class SweetAlertAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/sweetalert/';
    public $css = [
        'sweetalert.css',
    ];
    public $js = [
        'sweetalert.min.js'
    ];
}