<?php
require (__DIR__ . '/constant.php');
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone'=>'Asia/Chongqing',
    'components' => [
        'db' => require (__DIR__ . '/db.php'),
        'smsDb' => require (__DIR__ . '/smsDb.php'),
        'fcache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => [
                'hostname' => '127.0.0.1',
                'port' => 6379,
                'database' => 0,
            ],
            'keyPrefix' => 'sample',
        ],
    ],
];
