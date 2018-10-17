<?php
namespace app\backend\controller;
use think\Controller;
use think\AjaxPage;
use think\Db;

class User extends Controller
{
    // 会员列表页
    public function index()
    {
        $count = Db::name('users')->count();
        $Page = new AjaxPage($count,10);
        $userList = Db::name('users')->order('user_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        // dump($userList);

        $show = $Page->show();
        $this->assign('userList', $userList);
        $this->assign('page', $show); // 赋值分页输出
        $this->assign('pager', $Page);

        return $this->fetch();
    }

    // 会员列表
    public function ajaxindex(){
        $count = Db::name('users')->count();
        $Page = new AjaxPage($count,10);
        $userList = Db::name('users')->order('user_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        // dump($userList);

        $show = $Page->show();
        $this->assign('userList', $userList);
        $this->assign('page', $show); // 赋值分页输出
        $this->assign('pager', $Page);
        return $this->fetch();
    }
}
