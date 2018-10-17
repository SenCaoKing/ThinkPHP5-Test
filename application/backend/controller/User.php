<?php
namespace app\backend\controller;
use think\Controller;
use think\AjaxPage;
use think\Db;
use app\common\model\Users;

class User extends Controller
{
    // 会员列表页
    public function index()
    {
        $userModel = new Users();
        $count = $userModel->count();
        $Page = new AjaxPage($count, 10);
        $userList = $userModel->order('user_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $show = $Page->show();
        $this->assign('userList', $userList);
        $this->assign('page', $show); // 分页赋值输出
        $this->assign('pager', $Page);

        return $this->fetch();
    }

    // 会员列表
    public function ajaxindex(){
        $userModel = new Users();
        $count = $userModel->count();
        $Page = new AjaxPage($count, 10);
        $userList = $userModel->order('user_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        
        $show = $Page->show();
        $this->assign('userList', $userList);
        $this->assign('page', $show); // 分页赋值输出
        $this->assign('pager', $Page);
        return $this->fetch();
    }
}
