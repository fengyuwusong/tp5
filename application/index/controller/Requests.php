<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Requests extends Controller
{
    // 传统方式调用
    public function demo1($name = 'World')
    {
        $request = Request::instance();
        // 获取当前url地址，不含域名
        echo "url:" . $request->url() . "<br/>";
        return 'Hello, ' . $name;
    }
    // 简化
    public function demo3(Request $request, $name = 'World')
    {
        // 获取当前url地址，不含域名
        echo "url:" . $request->url() . "<br/>";
        return 'Hello, ' . $name;
    }
    // 继承controller
    public function demo2($name = 'World')
    {
        // echo "url:" . $this->request->url();
        // 更简便方法
        echo url();
    }
    // 使用助手函数调用
    public function demo4()
    {
        echo request()->url();
    }
    // 请求信息
    // 获取请求变量 param
    public function demo5(Request $request)
    {
        echo "请求参数：";
        dump($request->param());
        echo 'naem:' . $request->param('name');
    }
    // 简化方法 input 优先级 ：路由变量>$_POST>$_GET
    public function demo6()
    {
        echo "请求参数：";
        dump(input());
        echo 'naem:' . input('name');
    }
    // 设置过滤参数 ，默认值
    public function demo7()
    {
        // thinkphp 默认值，strtoupper转换为大写
        echo input('name', 'thinkphp', 'strtoupper');
    }
    // Request获取其他参数的输入
    public function demo8(Request $request)
    {
        echo "get参数：";
        dump($request->get('name'));
        echo "post参数：";
        dump($request->post('name'));
        echo "cookie参数：";
        dump($request->cookie('name'));
        echo "session参数：";
        dump($request->session('name'));
        echo "文件信息：";
        dump($request->file('image'));
    }
    // 获取详细请求
    public function demo9(Request $request)
    {
        echo '请求方法:' . $request->method() . '<br/>';
        echo '资源类型:' . $request->type() . '<br/>';
        echo '访问ip:' . $request->ip() . '<br/>';
        echo '是否Ajax请求:'var_export($request->isAjax(), true) . '<br/>';

    }
}
