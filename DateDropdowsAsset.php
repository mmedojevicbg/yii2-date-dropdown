<?php
namespace mmedojevicbg\DateDropdown;
use yii\web\AssetBundle;

class DateDropdownAsset extends AssetBundle
{
    public $js = [
        'script.js',
    ];
    public $css = [
        'style.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
    ];
    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}