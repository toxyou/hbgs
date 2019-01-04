<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
        if(!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_username'])){
            $this->redirect("Home/Public/login");
        }
    }

}