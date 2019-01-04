<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index()
    {
        $this->redirect('Datalist/lists');
    }

    /***
     * 修改密码
     */
    public function changePassword(){
        if(IS_POST){
            $old_password = I('old_password','','md5');
            $new_password = I('new_password','','md5');
            $map['id']    = $admin_id = session('admin_id');
            $admin = M('admin')->where($map)->find();  //根据当前session('admin_id')，查找原密码
            if($old_password === $admin['password']){  //检测原始密码是否正确
                $admin = M('admin')->where(array('id'=>$admin_id))->setField('password',$new_password); //更改密码
                if($admin !== false){
                    $res['status']  = 1;
                    $res['message'] = '更改成功';
                    $this->ajaxReturn($res);
                }else{
                    $res['status']  = 0;
                    $res['message'] = '更改失败';
                    $this->ajaxReturn($res);
                }
            }else{
                $res['status']  = 0;
                $res['message'] = '更改失败，原始密码错误';
                $this->ajaxReturn($res);
            }
        }else{
            $this->display();
        }
    }



}