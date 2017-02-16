<?php
// * @Description: User表单验证
// * @Author     : 风雨雾凇
// * @DateTime   : 2017-02-15 23:33:44
namespace app\index\validate;

use think\Validate;

class User extends Validate
{
    // 验证规则
    // 昵称 必须 长度最小5
    // 邮箱必须 合法
    // 生日可选 符合dateTime Y-m-d
    protected $rule = [
        // | 错误提示
        'nickname|昵称' => ['require', 'min' => 5, 'token'],
        'email|邮箱'    => ['require', 'chechEmail:think.cn'],
        'birthday|生日' => ['dateFormat' => 'Y-m-d'],
    ];
    // 详细提示
    // protected $rule = [
    //     ['nickname', 'require|min:5|token', '昵称必须填写|长度不能小于5|必须经过token验证'],
    // ];
    protected function chechEmail($value, $rule)
    {
        $res = preg_match('/^\w+([-+.]\w+)*@' . $rule . '$/', $value);
        if (!$res) {
            return "邮箱只能是" . $rule . '域名';
        } else {
            return true;
        }
    }
}
