<?php
// * @Description: blog路由控制
// * @Author     : 风雨雾凇
// * @DateTime   : 2017-02-12 15:02:21
namespace app\index\controller;

use think\Controller;

class Blog extends Controller
{
    // 变量规则
    public function read($name)
    {
        return "查看name=" . $name . "的内容";
    }
    public function get($id)
    {
        return "查看id=" . $id . "的内容";
    }
    public function archive($year, $month)
    {
        return "查看" . $year . "年" . $month . "月的内容";
    }
}
