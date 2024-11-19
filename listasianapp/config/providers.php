<?php

return array(
    "base_url" => Yii::app()->controller->createAbsoluteUrl('site/login'),
    "providers" => array(
        "Google" => array (
            "enabled" => true,
            "keys" => array (
                "id"     => "165556968759-bal40niiudfrc6su4hbvgc3tmgm3ssro.apps.googleusercontent.com",
                "secret" => "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",
            ),
            "scope" => "email profile"
        ),

        "Facebook" => array (
            "enabled" => true,
            "keys" => array (
                "id"     => "922733551110727",
                "secret" => "c02e5fcf1b52275d9be406fc2c1d79c3",
            ),
            "scope" => "email"
        ),
    ),
    // If you want to enable logging, set 'debug_mode' to true.
    // You can also set it to
    // - "error" To log only error messages. Useful in production
    // - "info" To log info and error messages (ignore debug messages)
    "debug_mode" => true,
    // Path to file writable by the web server. Required if 'debug_mode' is not false
    "debug_file" => Yii::app()->runtimePath . '/provider.log',
);