<?php
namespace Admin\Controller;
use Think\Controller;

class MiddleLevelController extends BaseController {

    public function lists(){
        $keyword = I('keyword','','trim');      //过滤开头结尾空格
        if($keyword){
            $map['middle_name'] = array('like',"%$keyword%");//模糊查询
            $this->assign('keyword',$keyword);  //输出数据
        }
        $count  = M('MiddleLevel')->where($map)->count();
        $row    = 10;
        $Page   = new \Think\Page($count,$row);
        $show   = $Page->show();
        $datalists  = D('MiddleLevel')->relation(true)->where($map)->order('high_id desc , sort desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $this->assign('page',$show);// 赋值分页输出
        $title = '中级分类管理';
        $this->assign('title',$title);
        $this->assign('datalists',$datalists);
        $this->display();
    }

    /**
     * 新增 or 编辑
     */
    public function add(){
        if(IS_POST){
            $data = I('post.');
            if($data['id']){
                $res  = M('middle_level')->where(array('id'=>$data['id']))->save($data);
            }else{
                $res  = M('middle_level')->add($data);
            }
            if($res !== false){
                $this->success('操作成功',U('lists'));
            }else{
                $this->error('操作失败');
            }
        }else{
            if(I('id',0,'int')){
                $map['id']    = I('id',0,'int');
                $middle_level = M('middle_level')->where($map)->find();
                $this->assign('data',$middle_level);
            }
            $high_level = M('high_level')->select();
            $this->assign('high_level',$high_level);
            $this->display();
        }
    }

    /**
     * 单选删除
     */
    public function delete(){
        $map['id']  = $middle_id = I('id',0,'int');
        $elementary = M('elementary_level')->where(array('middle_id'=>$middle_id))->select();
        if($elementary){
            $message = '请先删除该中级分类下的初级分类';
            $this->ajaxReturn($message);
        }
        $res = M('middle_level')->where($map)->delete();
        if($res){
            $message = '删除成功';
        }else{
            $message = '删除失败';
        }
        $this->ajaxReturn($message);
    }

    /**
     * 全选删除
     */
    public function delAll(){
        $ids = I('ids',0);
        //判断该中级分类下是否有初级分类
        $where['middle_id'] = array('in',$ids);
        $datalist    = M('elementary_level')->where($where)->select();
        if($datalist){
            $message = '请先删除该中级分类下的初级分类';
            $this->ajaxReturn($message);
        }
        $map['id']  = array('in',$ids);
        if(M('middle_level')->where($map)->delete()){
            $message = '删除成功';
        }else {
            $message = '删除失败';
        }
        $this->ajaxReturn($message);
    }


}