<?php
// * @Description: 请求对象Request demo
// * @Author     : 风雨雾凇
// * @DateTime   : 2017-02-13 15:25:29

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
        echo '是否Ajax请求:' . var_export($request->isAjax(), true) . '<br/>';
        echo '访问ip:' . $request->ip() . '<br/>';
        echo '请求参数:';
        dump($request->param());
        echo "请求参数，仅包含name";
        dump($request->only(['name']));
        echo '请求参数，排除name';
        dump($request->except(['name']));
    }
    // 获取url信息
    public function demo10(Request $request)
    {
        // 获取当前域名
        echo "domain:" . $request->domain() . '<br/>';
        // 获取入口文件
        echo 'file:' . $request->baseFile() . '<br/>';
        // 获取当前url地址，不含域名
        echo 'url:' . $request->url() . '<br/>';
        // 获取完整地址
        echo 'url:' . $request->url(true) . '<br/>';
        // 获取当前url ，不含query_string
        echo 'baseurl:' . $request->baseUrl(true) . '<br/>';
        // 获取url访问的root地址
        echo 'root:' . $request->root() . '<br/>';
        // 获取url中path_info信息
        echo 'pathinfo:' . $request->pathinfo() . '<br/>';
        // 获取url中path_info信息 不含后缀
        echo 'pathinfo:' . $request->path() . '<br/>';
        // 获取url后缀信息
        echo 'ext:' . $request->ext() . '<br/>';
    }
    // 获取当前模块，控制器，操作
    public function demo11(Request $request)
    {
        echo "模块：" . $request->module();
        echo '控制器：' . $request->controller();
        echo "操作：" . $request->action();
    }
}
