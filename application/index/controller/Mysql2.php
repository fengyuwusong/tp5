<?php
// * @Description: mysql查询语言
// * @Author     : 风雨雾凇
// * @DateTime   : 2017-02-14 15:32:58
namespace app\index\controller;

use think\Controller;
use think\Db;

class Mysql2 extends Controller
{
    // 使用name 代替之前table 不用在加前缀 配置文件获取
    public function demo1()
    {
        // $res = Db::name('data')
        //     ->where('id', 11)
        //     ->find();
        // 等效
        $res = Db::name('data')
            ->where('id', '=', 11)
            ->find();
        dump($res);
    }
    // EQ =     等于
    // NEQ      不等于
    // GT >     大于
    // EGT >=     大于等于
    // LT <        小于
    // ELT <=    小于等于
    // LIKE     模糊查询
    // [NOT] BETWEEN [不在]区间查询
    // [IN]     [不在]IN查询
    // [NOT] NULL [不]空
    // [NOT] EXISTS [不]存在
    // EXP         表达式查询
    // 查询id大于1的数据
    public function demo2()
    {
        // $res = Db::name('data')->where('id', 'gt', '1')->limit(2)->select();
        // 等效
        $res = Db::name('data')->where('id', 'exp', '>1')->limit(2)->select();
        dump($res);
    }
    // in查询
    public function demo3()
    {
        $res = Db::name('data')->where('id', 'in', [1, 2, 11, 12])->select();
        dump($res);
    }
    // between查询
    public function demo4()
    {
        $res = Db::name('data')->where('id', 'between', [10, 12])->select();
        var_dump(Db::name('data')->getLastSql());
        dump($res);
    }
    // like模糊查询
    public function demo5()
    {
        $res = Db::name('data')->where('name', 'like', '%think%')->select();
        dump($res);
    }
    // null 查询
    public function demo6()
    {
        $res = Db::name('data')->where('name', 'null')->select();
        dump($res);
    }
    // 批量查询
    public function demo7()
    {
        $res = Db::name('data')
            ->where([
                'id'   => ['between', [10, 12]],
                'name' => ['like', '%think%'],
            ])->select();
        var_dump(Db::name('data')->getLastSql());
        dump($res);
    }
    // 快捷查询
    public function demo8()
    {
        // and
        $res = Db::name('data')
            ->where('id&status', '>', 0)
            ->limit(10)
            ->select();
        dump($res);
        // or
        $res = Db::name('data')
            ->where('id|status', '>', 0)
            ->limit(10)
            ->select();
    }
    // 视图查询
    public function demo9()
    {
        $res = Db::view('data', 'id,name,status')
            ->view('profile', ['name' => 'truename', 'phone', 'email'], 'profile.user_id=user.id')
            ->where('status', 1)
            ->order('id desc')
            ->select();
        dump($res);
    }
    // 闭包查询
    public function demo10()
    {
        $res = Db::name('data')->select(function ($query) {
            $query->where('name', 'like', '%think%')
                ->where('id', 'in', '1,2,3')
                ->limit(10);
        });
        var_dump(Db::name('data')->getLastSql());
        var_dump($res);
    }
    // Query对象 select方法之前调用任何的链式操作无效
    public function demo11()
    {
        $query = new \think\Db\Query;
        $query->name('data')->where('name', 'like', '%think%')->limit(2);
        $res = Db::select($query);
        dump($res);
    }
    // 获取数值
    public function demo12()
    {
        $name = Db::name('data')
            ->where('id', '12')
            ->value('name');
        dump($name);
        var_dump(Db::name('data')->getLastSql());
    }
    // 获取列数据
    public function demo13()
    {
        $list = Db::name('data')
            ->where('status', 2)
            ->column('name');
        // 以主键为索引
        $list = Db::name('data')
            ->where('status', 2)
            ->column('status,name', 'id');
        dump($list);
    }
    // 聚合查询
    // max min
    // count 统计
    // avg 平均
    // sum 总计
    public function demo14()
    {
        // 统计data表的数据
        $count = Db::name('data')
            ->where('status', 2)
            ->count();
        dump($count);
        // 统计status最大
        $max = Db::name('data')
            ->avg('status');
        dump($max);
    }
    // 使用原生语句 配合绑定参数
    public function demo15()
    {
        $res = Db::name('data')
            ->where('id>:id and name is not null', ['id' => 10])
            ->select();
        dump($res);
    }
    // 时间日期查询
    public function demo16()
    {
        $db = db('data');
        // $db->insert(['id' => 5, 'name' => 'demo16', 'status' => 1, 'create_time' => date('Y-m-d H:i:s', time())]);
        // 查询大于2016-1-1 的结果
        $res = $db->whereTime('create_time', '>', '2016-1-1')->select();
        dump($res);
        // 查询本周添加的数据
        $res = $db->whereTime('create_time', '>', 'this week')
            ->select();
        // 查询近两天添加的数据
        $res = $db->whereTime('create_time', '>', '-2 days')
            ->select();
        // 查询创建在两个时间之间的数据
        $res = $db->whereTime('create_time', 'between', ['2016-1-1', 'this day'])
            ->select();
        dump($db->getLastSql());
        dump($res);
        $res = $db->whereTime('create_time', 'between', ['last year', 'yesterday'])
            ->select();
        dump($res);
    }
    // 分块查询
    // 为查询大量数据设计
    // 假设有1W条数据，可将其分成100次处理 ，每次处理100条数据
    public function demo17()
    {
        Db::name('data')
            ->where('status', '>', 0)
            ->chunk(100, function ($list) {
                // 处理100条数据
                foreach ($list as $key => $value) {
                    dump($value);
                    // 如在某个特定条不希望继续 return false
                }
            });
        //  },'status'); 按照主键查询 如不希望添加参数
    }
}
