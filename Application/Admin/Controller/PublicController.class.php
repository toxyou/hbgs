<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function login(){
        if(IS_POST){
            //检测验证码是否正确
            $code   = I('code');
            $verify = $this->check_verify($code);
            if(!$verify){
                $res['status']  = 0;
                $res['message'] = '验证码错误!';
                $this->ajaxReturn($res);
            }
            //检测用户名和密码是否正确
            $username = I("username",'','trim');
            $password = I("password",'','md5');
            $admin    = M("admin")->where(array("username"=>$username))->find();
            if(!$admin || $admin['password'] != $password){
                $res['status']  = 0;
                $res['message'] = '用户名或者密码错误!';
                $this->ajaxReturn($res);
            }else{
                $data = array(
                    "loginip"  =>get_client_ip(),
                    "logintime"=>date("Y-m-d H:i:s"),
                );
                M("admin")->save($data);
                session('admin_id',$admin["id"]);
                session('admin_username',$admin["username"]);
                $res['status']  = 1;
                $res['message'] = '登录成功!';
                $this->ajaxReturn($res);
            }
        }else{
            //判断session是否存在，session存在不需登录，直接跳转
            if(session('admin_id') || session('admin_username')){
                $this->redirect("Admin/Datalist/lists");
            }else{
                $this->display();
            }
        }
    }

    /**
     * 产生验证码方法
     */
    public function verify(){
        $config =    array(
            'fontSize' => 15,    // 验证码字体大小
            'length'   => 4,     // 验证码位数
            'useNoise' => false, // 关闭验证码杂点
            'imageW'   => 108,   // 图片宽度
            'imageH'   => 42,    // 图片高度
            'codeSet'  => '0123456789',//随机产生0-9中的数字
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    /**
     * 检验登录信息
     */
    public function checkLogin(){
        /**检测验证码是否正确**/
        $code     = I('code');               	//接收验证码
        $verify   = $this->checkCode($code);	//调用checkCode方法
        if(!$verify){
            $res['status']  = 0;
            $res['message'] = '验证码错误!';
            $this->ajaxReturn($res);
        }
        /**检测用户名密码是否正确**/
        $username = I("username"," ","trim"); 	//接收用户名，并且使用trim函数去除首尾空格
        $password = I("password"," ","md5");	//接收密码，并且使用md5函数加密
        $return   = $this->checkPassword($username,$password);

        if(!$return){
            $res['status']  = 0;
            $res['message'] = '用户名或者密码错误!';
            $this->ajaxReturn($res);
        }else{
            $data = array(
                "login_ip"  =>get_client_ip(),      //获取ip地址
                "login_time"=>date("Y-m-d H:i:s"),  //记录登录日期
            );
            M("admin")->save($data);                 //增加数据
            session('admin_id', $return["id"]);     //将admin_id存入session
            session('admin_username', $return["username"]); //将admin_username存入session
            $res['status']  = 1;
            $res['message'] = '登录成功!';
            $this->ajaxReturn($res);
       }

    }



    /**
     * 检测用户输入验证码是否正确
     * @param $code ：输入的验证码
     * @return bool ：验证码正确返回true，否则返回false
     */
    public function checkCode($code){
        $verify = new \Think\Verify();
        return $verify->check($code);		//调用检验方法
    }


    /***
     * 检测用户名密码是否匹配
     * @param $username
     * @param $password
     * @return bool
     */
    public function checkPassword($username,$password){
        $map['username'] = $username;
        $admin = M('admin')->where($map)->find();
        if($admin['password'] === $password){
            return $admin;
        }else{
            return false;
        }
    }


    /**
     * 退出
     */
    public function logout(){
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
        $this->redirect("login");
    }


}