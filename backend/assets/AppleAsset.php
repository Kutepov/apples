<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for manage apples.
 */
class AppleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/apple.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'backend\assets\ToastrAsset',
    ];
}
