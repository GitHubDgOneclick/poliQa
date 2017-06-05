<?php

$params = require(__DIR__ . '/params.php');
Yii::setAlias('@pathImagenes', __DIR__ . '/../web/img/');
Yii::setAlias('@pathArchivos', __DIR__ . '/../web/files/');
#Yii::setAlias('@pathUrlAplication', 'http://ec2-54-172-245-23.compute-1.amazonaws.com');
Yii::setAlias('@pathUrlAplication', 'http://localhost:8181/poliQa/web/');
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'es',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Xy06aDF64i9bYP8oFuQH9xRkLgMmHncv',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Usuario',
            'enableAutoLogin' => true,
            'loginUrl' => ['usuario/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'ldap' => require(__DIR__ . '/ldap.php'),
        'urlManager' => [
           #'class' => 'yii\web\UrlManager',
           #'enablePrettyUrl' => true,
            #'showScriptName' => false,
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
       ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    #$config['bootstrap'][] = 'debug';
    #$config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
