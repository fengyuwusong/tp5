<?php
// * @Description: index模块数据库配置
// * @Author     : 风雨雾凇
// * @DateTime   : 2017-02-13 21:01:23

return [
    // 数据库名
    'database' => 'demo',
    // 表前缀
    'prefix'   => 'think_',
    // 数据库连接参数
    'parms'    => [
        // 使用长连接
        \PDO::ATTR_PERSISTENT => true,
    ],
]?>
