<?php

return [
    'hook' => 'site/hook',
    'c/<code:[\w\-]+>/<page:\d+>' => 'category/index',
    'test/<code:[\w\-]+>/<page:\d+>' => 'category/test',
    'c/<code:[\w\-]+>' => 'category/index',
    'test/<code:[\w\-]+>' => 'category/test',
    'a/<id:\d+>/<country>/<region>/<subcategory>/<name>.html' => 'advert/display',
    'a/<id:\d+>/*' => 'advert/display',
    'adv/<id:\d+>/*' => 'advert/display',
    'adverts' => 'advert/index',
    'payments' => 'paylog/index',
    'login' => 'site/login',
    'register' => 'site/register',
    'restore' => 'site/restore',
    '<type:(platinum|silver)>/<url:[-\w]+>' => 'category/paidAdverts',
    '<page:\d+>' => 'category/index',
    '' => 'category/index',
    'geo/regions' => 'geo/regions',

    //json api2
//    'api1.1/<name:\w+>'=>
//    [
//        'advert/REST.GET',
//        'verb'=>'GET',
//        'caseSensitive' => false,
//        'defaultParams' =>
//        [
//            'filter' => CJSON::encode([
//                [
//                    'property' => 'name',
//                    'value' => $_GET['name']
//                ]
//            ])
//        ]
//    ],
];
