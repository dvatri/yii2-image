<?php

namespace tunect\yii2image;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $name = Module::$moduleName;

        if ($app instanceof \yii\web\Application) {
            if (!$app->hasModule($name)) {
                $app->setModule($name, new Module($name));
            }

            $rules[] = [
                'class' => 'yii\web\GroupUrlRule',
                'prefix' => $name,
                'rules' => [
                    '/' => 'default/index',
                    '<version:[\w-]+>/<id:\d+>' => 'default/view',
                    '<controller:[\w-]+>/<action:[\w-]+>' => '<controller>/<action>',
                ],
            ];

            $app->getUrlManager()->addRules($rules, false);

        } elseif ($app instanceof \yii\console\Application) {
            //https://github.com/yiisoft/yii2/issues/384#issuecomment-63638791
            //$app->params['yii.migrations'][] = '@tunect/yii2image/migrations';
        }
    }

}
