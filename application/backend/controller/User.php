<?php
namespace app\backend\controller;
use think\Controller;
use think\Db;

class User extends Controller
{
    public function index()
    {

        $list = Db::name('users')->select();
        // dump($list);

        $this->assign('list', $list);
        return $this->fetch();
    }
}
