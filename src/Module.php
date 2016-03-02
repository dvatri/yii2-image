<?php

namespace tunect\yii2image;

use Yii;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module
{
    public static $moduleName = 'image';

    public $versions = [
        'as-is'=>[],
        'small'=>[200, 200],
    ];

    public $attribute = 'imageFiles';

    public function init()
    {
        parent::init();
    }

    public function createVersion($id, $version)
    {

    }



}
