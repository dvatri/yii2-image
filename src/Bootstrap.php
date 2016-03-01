<?php

namespace tunect\yii2image;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public $name = 'image';

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {

            $app->setModule($this->name, new Module($this->name));

            $rules[] = [
                'class' => 'yii\web\GroupUrlRule',
                'prefix' => $this->name,
                'rules' => [
                    '/' => 'default/index',
                    '<id:\d+>' => 'default/view',
                    '<controller:[\w-]+>/<action:[\w-]+>' => '<controller>/<action>',
                ],
            ];

            $app->getUrlManager()->addRules($rules, false);

            \yii\helpers\VarDumper::dump(Yii::$app->urlManager, 10, true);
        } elseif ($app instanceof \yii\console\Application) {
            //https://github.com/yiisoft/yii2/issues/384#issuecomment-63638791
            //$app->params['yii.migrations'][] = '@tunect/yii2image/migrations';
        }
    }
    
}
