<?php
// * @Description: response demo
// * @Author     : 风雨雾凇
// * @DateTime   : 2017-02-13 15:30:43

namespace app\index\controller;

use think\Controller;

class Responses extends Controller
{
    // 手动输出
    public function demo1()
    {
        $data = ['name' => 'thinkphp', 'status' => '1'];
        // return json($data);
        // 默认发送和状态码200 如特殊需要发送201 更多响应头
        return json($data, 201, ['Cache']);
    }
    // 若已经继承Controller 则无需引入
    // use \traits\controller\Jump;
    // 页面跳转
    public function demo2($name = '')
    {
        if ($name == 'thinkphp') {
            $this->success('欢迎使用thinkphp5.0', 'demo1');
        } else {
            $this->error('name参数错误！', 'demo1');
        }
    }
    // 重定向
    public function demo3($name = '')
    {
        if ($name == 'thinkphp') {
            // $this->redirect('http://www.thinkphp.cn');
            // 通过助手函数
            return redirect('http://www.thinkphp.cn');
        } else {
            $this->error('name参数错误！', 'demo1');
        }
    }
}
