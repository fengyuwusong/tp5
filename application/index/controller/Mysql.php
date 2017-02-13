<?php
// * @Description: 数据库
// * @Author     : 风雨雾凇
// * @DateTime   : 2017-02-13 19:43:32

namespace app\index\controller;

use think\Db;

class Mysql
{
    // 原生查询
    // 插入 execute 返回只有成功1 与否 0
    public function demo1()
    {
        $res = Db::execute('insert into think_data (id, name, status) values (5,"thinkphp",1)');
        dump($res);
    }
    //更新
    public function demo2()
    {
        $res = Db::execute('update think_data set name ="framework" where id =5');
        dump($res);
    }
    // 读取 使用query
    public function demo3()
    {
        $res = Db::query('select * from think_data');
        dump($res);
    }
    // 删除
    public function demo4()
    {
        $res = Db::execute('delete from think_data where id=5');
        dump($res);
    }
    // 其他操作
    public function demo5()
    {
        // 显示数据库列表
        $res = Db::query('show tables from demo');
        dump($res);
        // 清空数据表
        $res = Db::execute('truncate table think_data');
        dump($res);
    }
    // 多数据库配置 查看config.php文件
    public function demo6()
    {
        // $res = Db::connect('mysql://root:root@127.0.0.1:3306/demo#utf8')->query('select * from think_data');
        $res = Db::connect('db1')->query('select * from think_data');
        dump($res);
    }
    // 参数绑定
    public function demo7()
    {
        // Db::execute('insert into think_data (id, name, status) values (?,?,?)', [8, 'thinkphp', '1']);
        // 命名占位符支持
        // Db::execute('insert into think_data (id, name, status) values (:id, :name, :status)', ['id' => 10, 'name' => 'demo', 'status' => '3']);
        $res = Db::query('select * from think_data');
        dump($res);
    }
    // 查询构造器
    public function demo8()
    {
        // 插入记录
        // Db::table('think_data')
        // ->insert(['id' => 12, 'name' => 'demo2', 'status' => '4']);
        //     更新记录
        // Db::table('think_data')
        //     ->where('id', 12)
        //     ->update(['name' => 'hello']);
        // 查询记录
        $list = Db::table('think_data')
            ->select();
        dump($list);
        // 删除记录
        Db::table('think_data')
            ->where('id', 12)
            ->delete();
        // 函数助手调用
        $db  = db('data');
        $res = $db->select();
        dump($res);
    }
    // 链式操作 完成复杂的数据库查询操作
    // select 查询数据集
    // find 查询单个数据
    // insert 插入记录
    // update 更新
    // delete 删除
    // value 查询值
    // column 查询列
    // chunk 分块查询
    // count等 聚合查询
    public function demo9()
    {
        $db   = db('data');
        $list = $db
            ->where('status', 3)
            ->field('name')
            ->order('id', 'desc')
            ->limit(10)
            ->select();
        dump($list);
    }
    // 事务支持 需要数据表储存结构为InnoDB 而不是MyISAM 必须使用同一数据库
    // 不支持函数助手调用
    public function demo10()
    {
        // 自动控制
        // Db::transaction(function () {
        //     Db::table('think_data')->insert(['id' => 15, 'status' => '2', 'name' => 'test']);
        //     Db::table('think_data')->insert(['id' => 14, 'status' => '2', 'name' => 'test']);
        // });
        // 手动控制
        // 启动事务
        Db::startTrans();
        try {
            Db::table('think_data')->insert(['id' => 15, 'status' => '2', 'name' => 'test']);
            Db::table('think_data')->insert(['id' => 14, 'status' => '2', 'name' => 'test']);
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            echo "事务回滚";
            Db::rollback();
        }
    }
}
