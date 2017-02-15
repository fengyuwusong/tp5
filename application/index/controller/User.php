<?php
// * @Description: user控制器
// * @Author     : 风雨雾凇
// * @DateTime   : 2017-02-15 14:21:09

namespace app\index\controller;

// as 给别名UserModel 为了避免与当前 app\index\controller\User 冲突
use app\index\model\User as UserModel;

class User
{
    // 新增用户数据
    public function add()
    {
        // 方法一
        // 避免冲突User
        $user           = new UserModel;
        $user->nickname = '流年';
        $user->email    = 'thinkphp@qq.com';
        $user->birthday = '1977-03-05';
        if ($user->save()) {
            return '用户[' . $user->nickname . ":" . $user->id . ']新增成功！';
        } else {
            return $user->getError();
        }
        // 方法二
        // 可以是对象 数组 表单数据
        // $user['nickname'] = '看云';
        // $user['email']    = 'kanyun@qq.com';
        // $user['birthday'] = strtotime('2015-04-02');
        // if ($res = UserModel::create($user)) {
        //     return '用户[' . $res->nickname . ":" . $res->id . ']新增成功！';
        // } else {
        //     return '错误！';
        // }
    }
    // 批量新增
    public function addList()
    {
        $user = new UserModel;
        $list = [
            [
                'nickname' => '张三', 'email' => 'zhangsan@qq.com', 'birthday' => strtotime('1998-01-15'),
            ],
            [
                'nickname' => '李四', 'email' => 'lisi@qq.com', 'birthday' => strtotime('1998-01-15'),
            ],
        ];
        if ($user->saveAll($list)) {
            return "批量新增成功！";
        } else {
            return $user->getError();
        }
    }
    // 查询数据 无id默认查询第一条
    public function read($id = '')
    {
        $user = UserModel::get($id);
        echo $user->nickname . '<br/>';
        echo $user->email . '<br/>';
        echo $user->birthday . '<br/>';
        echo $user->create_time . '<br/>';
        echo $user->status . '<br/>';
        // echo $user->user_birthday;
        // 不根据主键查询
        // 方法一
        $user2 = UserModel::get(['email' => 'thinkphp@qq.com']);
        // echo $user2->nickname;
        // 方法二
        $user3 = UserModel::getByEmail('thinkphp@qq.com');
        // echo $user->birthday;
        // 复杂查询
        $user4 = UserModel::where('email', 'like', '%think%')->find();
        // dump($user4->nickname);
    }
    // 数据列表 查询多个数据 查询范围
    public function index()
    {
        $list = UserModel::all();
        foreach ($list as $key => $user) {
            echo $user->nickname . '<br/>';
            echo $user->email . '<br/>';
            // echo date('Y-m-d', $user->birthday) . '<br/>';
            echo "------------------------------------<br/>";
        }
        // $list = UserModel::all(['status' => 1]);
        // foreach ($list as $key => $user) {
        //     echo $user->nickname . '<br/>';
        //     echo $user->email . '<br/>';
        //     echo date('Y-m-d', $user->birthday) . '<br/>';
        //     echo "------------------------------------<br/>";
        // }
        // $list = UserModel::where('id', 'gt', '3')->select();
        // foreach ($list as $key => $user) {
        //     echo $user->nickname . '<br/>';
        //     echo $user->email . '<br/>';
        //     echo date('Y-m-d', $user->birthday) . '<br/>';
        //     echo "------------------------------------<br/>";
        // }
        // 查询范围
        // $list = UserModel::scope('email, status')->all();
        // foreach ($list as $key => $user) {
        //     echo $user->nickname . '<br/>';
        //     echo $user->email . '<br/>';
        //     echo $user->birthday . '<br/>';
        //     echo $user->status . '<br/>';
        //     echo "------------------------------------<br/>";
        // }
        // 等效
        // $list = UserModel::scope('email')->scope('status')->all();
        // foreach ($list as $key => $user) {
        //     echo $user->nickname . '<br/>';
        //     echo $user->email . '<br/>';
        //     echo $user->birthday . '<br/>';
        //     echo $user->status . '<br/>';
        //     echo "------------------------------------<br/>";
        // }
        // 可闭包
        // $list = UserModel::scope('email, status')
        //     ->scope(function ($query) {
        //         $query->order('id', 'desc');
        //     })->all();
        // foreach ($list as $key => $user) {
        //     echo $user->nickname . '<br/>';
        //     echo $user->email . '<br/>';
        //     echo $user->birthday . '<br/>';
        //     echo $user->status . '<br/>';
        //     echo "------------------------------------<br/>";
        // }
        // 支持参数
        // $list = UserModel::scope('email', 'thinkphp@qq.com')
        //     ->scope(function ($query) {
        //         $query->order('id', 'desc');
        //     })->all();
        // foreach ($list as $key => $user) {
        //     echo $user->nickname . '<br/>';
        //     echo $user->email . '<br/>';
        //     echo $user->birthday . '<br/>';
        //     echo $user->status . '<br/>';
        //     echo "------------------------------------<br/>";
        // }
    }
    // 更新数据
    public function update($id)
    {
        $user           = UserModel::get($id);
        $user->nickname = '刘晨';
        $user->email    = 'liu21st@gmail.com';
        if (false !== $user->save()) {
            return "更新成功！";
        } else {
            return $user->getError();
        }
        // 默认情况下同一对象get之后save操作的都是update 如若需要insert操作则需调用isUpdate
        //$user->isUpdate(false)->save() 则可插入查询的数据
        //此更新方法需要先读取相应的数据 若需要更高效的方法
        // $user['id']    = $id;
        // $user['email'] = 'liu22st@gmail.com';
        // $res           = UserModel::update($user);
        // return '更新成功！';
    }
    // 删除
    public function delete($id)
    {
        $user = UserModel::get($id);
        if ($user) {
            $user->delete();
            return "删除用户成功！";
        } else {
            return "用户不存在！";
        }
        // 高效方法 destroy
        $res = UserModel::destroy($id);
        if ($res) {
            return "删除用户成功！";
        } else {
            return "用户不存在！";
        }
    }
}
