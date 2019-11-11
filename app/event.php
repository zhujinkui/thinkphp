<?php
// 事件定义文件
return [
    'bind'      => [
        //'MemberLogin' => 'app\event\MemberLogin',
    ],

    'listen'    => [
        'AppInit'       => [],
        'HttpRun'       => [],
        'HttpEnd'       => [],
        'LogLevel'      => [],
        'LogWrite'      => [],
        'RouteLoaded'   => [],
        //'MemberLogin' => ['app\listener\MemberLogin'],
    ],

    'subscribe' => [
        'app\subscribe\AppInit'
    ],
];
