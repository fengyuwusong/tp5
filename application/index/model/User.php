<?php
// * @Description: 模型与关联
// * @Author     : 风雨雾凇
// * @DateTime   : 2017-02-15 14:13:08

namespace app\index\model;

use think\Model;

class User extends Model
{
// 该模型讲自动关联 数据库前缀+当前模型类名的表 think_user
    // 如果模型名不符合这一规范 可以给当前的模型定义单独的数据表
    // 1.设置完整的数据表（包含前缀）
    // protected $table = 'think_user';
    // 2.不含前缀
    // protected $name = 'user';
    // 假如需要使用与配置不同的数据库连接 则设置数据库连接
    // protected $connection = [
    //     'type'     => 'mysql',
    //     'hostname' => '127.0.0.1',
    //     'database' => 'demo',
    //     'username' => 'root',
    //     'password' => 'root',
    //     'hostport' => '',
    //     'parms'    => '',
    //     'charset'  => 'utf8',
    //     'prefix'   => 'think_',
    //     'debug'    => 'true',
    // ];
    // 读取器 简化date日期的处理
    // 命名方法 get+属性名的驼峰命名+Attr
    // public function getBirthdayAttr($birthday)
    // {
    //     return date('Y-m-d', $birthday);
    // }
    // 定义数据表中不存在的字段 将原始生日和已经转化的分成两个属性birthday user_birthday
    // public function getUserBirthdayAttr($value, $data)
    // {
    //     return date('Y-m-d', $data['birthday']);
    // }
    // 修改器
    //由于日期是时间戳(int) 每次写入日期都必须转换 可用修改器解决
    // 命名方法 set+属性名的驼峰命名+Attr
    // protected function setBirthdayAttr($birthday)
    // {
    //     return strtotime($birthday);
    // }
    // 类型转换
    // 简单的类型转换可代替读取器和修改器完成相同的功能
    protected $type = [
        //设置birthay为时间戳整型
        'birthday' => 'timestamp:Y-m-d',
    ];
    // 自动时间戳
    // 在database.php开启自动写入时间戳字段 'auto_timestamp' => true;
    // 自动写入create_time 和update_time 字段中
    // 如果不是这两个字段则可修改
    // protected $createTime='字段名'
    // protected $updateTime='字段名'
    // 个别表不需要可关闭
    // protected $autoWriteTimestamp = false;
    // 默认插入为整型 可修改
    // protected $autoWriteTimestamp = 'datetime';

    // 自动完成 insert auto update 插入 全部 更新 三种方式时自动完成
    // protected $insert = ['status' => 1];
    // 若不确定 需判断
    protected $insert = ['status'];
    // value数据表数据  data用户填写数据
    protected function setStatusAttr($value, $data)
    {
        return '流年' == $data['nickname'] ? 1 : 2;
    }
    protected function getStatusAttr($value)
    {
        $status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
        return $status[$value];
    }
}
