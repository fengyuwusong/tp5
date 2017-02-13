<?php
// * @Description: Index控制器
// * @Author     : 风雨雾凇
// * @DateTime   : 2017-02-11 02:16:22

namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    // 可以通过url直接访问
    public function index($name = "World")
    {
        $this->assign('name', $name);
        return $this->fetch();
    }
    // 操作数据库
    public function db()
    {
        $data = Db::name('data')->find();
        var_dump($data);
    }
    // 生成url地址
    public function url()
    {
        echo url('blog/archive', ['year' => '2015', 'month' => '05']);
    }
    // route.php去除index控制器
    public function demo()
    {
        return "<h1>123</h1>";
    }
    // 不可以通过url直接访问
    protected function hello()
    {
        return "<h1>hello!</h1>";
    }
    private function hello1()
    {
        return "<h1>hello!</h1>";
    }
}
