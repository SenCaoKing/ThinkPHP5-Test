<?php
namespace app\backend\controller;
use think\Controller;
use think\Db;

class Admin extends Controller
{
    public function login()
    {

        $list = Db::name('users')->select();
        // dump($list);

        $this->assign('list', $list);
        return $this->fetch();
    }
}
