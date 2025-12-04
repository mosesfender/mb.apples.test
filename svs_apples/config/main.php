<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'siunov.mb.test',
    'name' => 'Тестовая задача',
    'homeUrl' => '/',
    'defaultRoute' => 'default',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'svs\apples\controllers',
    'language' => 'ru-RU',
    'components' => [
        'request' => [
            'baseUrl' => '',
            'cookieValidationKey' => '_uRtdnT7R510_',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'errorHandler' => [
            'class' => 'yii\web\ErrorHandler',
            'errorAction' => 'default/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'normalizer' => [
                'class' => '\yii\web\UrlNormalizer',
                'action' => \yii\web\UrlNormalizer::ACTION_REDIRECT_PERMANENT,
                'collapseSlashes' => true,
                'normalizeTrailingSlash' => true,
            ],
            'rules' => [
                '<controller:[\w \-]+>/<action:[\w \-]+>' => '<controller>/<action>',
                '<controller:[\w \-]+>/<action:[\w \-]+>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity_svs',
                'httpOnly' => true,
                'path' => '/',
            ],
        ],
    ],
    'modules' => [

    ],
    'params' => $params,
];
