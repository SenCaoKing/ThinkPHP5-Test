<?php
namespace app\backend\controller;
use think\Controller;
use think\Db;
use think\Loader;

class Admin extends Controller
{
    // 管理员列表
    public function index(){
        $list = array();
        $keywods = I('keywords/s');
        if(empty($keywods)){ // 开发者测试账号，测试用
            $res = Db::name('admin')->where('admin_id', 'not in', '2, 3')->select();
        }else{
            $res = Db::name('admin')->where('user_name', 'like', '%'.$keywods.'%')->where('admin_id', 'not in', '2, 3')->order('admin_id')->select();
        }

        if($res){
            foreach($res as $val){
                $val['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
                $list[] = $val;
            }
        }
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function admin_info(){


        return $this->fetch();
    }

    public function adminHandle(){
        $data =I('post.');

        $adminValidate = Loader::validate('Admin');
        if(!$adminValidate->scene($data['act'])->batch()->check($data)){
            $this->ajaxReturn(['status'=>-1, 'msg'=>'操作失败', 'result'=>$adminValidate->getError()]);
        }
        if(empty($data['password'])){
            unset($data['password']);
        }else{
            $data['password'] = encrypt($data['password']);
        }

        // $this->ajaxReturn($data);

        if($data['act'] == 'add'){
            unset($data['admin_id'], $data['act'], $data['auth_code']);
            $data['add_time'] = time();
            $res = Db::name('admin')->insert($data);
        }
        if($data['act'] == 'del' && $data['admin_id'] > 1){
            $res = Db::name('admin')->where('admin_id', $data['admin_id'])->delete();
        }

        if($res){
            $this->ajaxReturn(['status'=>1, 'msg'=>'操作成功', 'url'=>url('Backend/Admin/index')]);
        }else{
            $this->ajaxReturn(['status'=>-1, 'msg'=>'操作失败']);
        }


    }

    public function ajaxReturn($data, $type='json'){
        exit(json_encode($data));
    }

    /**
     * 管理员登陆
     */
    public function login()
    {

        return $this->fetch();
    }

}
