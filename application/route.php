<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // 简化路由模块控制器 路由参数定义
    'demo/'         => ['index/index/demo', ['method' => 'get', 'ext' => 'html']],
    // 闭包定义
    'test/[:name]$' => function ($name = "test") {
        return "Hello ," . $name;
    },
    // 变量控制 支持正则控制 路由分组 局部变量
    // '[blog]'        => [
    //     '/read/:name$'            => ['index/blog/read', ['method' => 'get', 'name' => '\w+']],
    //     '/get/:id$'               => ['index/blog/get', ['method' => 'get', 'id' => '\d+']],
    //     '/archive-<year>-<month>' => ['index/blog/archive', ['method' => 'get'], ['year' => '\d{4}', 'month' => '\d{2}']],
    // ],
    // 变量规则统一定义
    // 全局变量规则定义
    '__pattern__'   => [
        'name'  => '\w+',
        'id'    => '\d+',
        'year'  => '\d{4}',
        'month' => '\d{2}',
    ],
    '[blog]'        => [
        '/read/:name$'             => 'index/blog/read',
        '/get/:id$'                => 'index/blog/get',
        '/archive-<year>-<month>$' => 'index/blog/archive',
    ],
    // 模型定义准备工作
    '[user]'        => [
        '/index'      => 'index/user/index',
        '/create'     => 'index/user/create',
        '/add'        => 'index/user/add',
        '/add_list'   => 'index/user/addList',
        '/update/:id' => 'index/user/update',
        '/delete/:id' => 'index/user/delete',
        '/:id'        => 'index/user/read',
    ],
];
