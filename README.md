Yii2 image module
==================


Configuration
-------------
Run composer command:
```sh
composer require tunect/yii2-image:dev-master
```

Run migration command:
```sh
yii migrate --migrationPath=@tunect/yii2image/migrations
```

Extension will work without any additional configuration, but it can be added manualy in config file:
```php
...
'modules' => [
    'image' => [
        'class' => 'tunect\yii2image\Module',
        'attribute' => 'imageFiles',
        'versions' => [
            'as-is'=>[],
            'small'=>[200, 200],
        ],
    ],
],
...
```