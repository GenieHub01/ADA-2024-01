<?php

return [

    'modules'=>array(
        
    ),

    'components'=>[
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=adamdz_asiandi',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'schemaCachingDuration' => 36000,
            'attributes' => [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));",
            ],
            //'enableParamLogging'=>true,
            //'enableProfiling'=>true,
        ),
        'log'=>array(
        ),
        'cache'=>[
            'class'=>'CFileCache'
        ]
    ],

    'params'=>[
        'cacheTime' => 36000,
        'geoCacheTime' => 30*24*3600,
        // 'vk.access_token' => '3030631f3030631f3030631f333054dec2330303030631f6b2d9363c6fdbb195dea7fae',
        // 'locationiq.api_key' => 'pk.cd7e750ed7d418ad5020f14fe93809fc',
        'mapbox.api_key' => 'pk.eyJ1IjoiZGV0YWhlcm1hbmEiLCJhIjoiY20zd3dkMXlzMTltZjJxcTJwajU3bnp2dSJ9.-7A9JGwRklO5A8HZPsSULA',
        'geonames.username' => 'detahermana'
    ]

];
