<?php
namespace Admin\Controller;
use Think\Controller;

class HighLevelController extends BaseController {

    /**
     * 列表
     */
    public function lists(){
        $keyword = I('keyword','','trim');      //过滤开头结尾空格
        if($keyword){
            $map['high_name'] = array('like',"%$keyword%");//模糊查询
            $this->assign('keyword',$keyword);  //输出数据
        }
        $high_level = M('high_level');
        $count  = $high_level->count();         //high_level表总数据量
        $row    = 10;                           //每页显示条数
        $Page   = new \Think\Page($count,$row); //实例化分页类
        $show   = $Page->show();                //调用show方法
        $datalists = $high_level->where($map)->order('sort desc')
            ->limit($Page->firstRow.','.$Page->listRows) //结合limit方法
            ->select();
        $this->assign('page',$show);    //输出分页数据
        $title  = '高级分类管理';
        $this->assign('title',$title);
        $this->assign('datalists',$datalists);
        $this->display();
    }

    /**
     * 新增或者编辑
     */
    public function add(){
        $high_level = M('high_level');
        if(IS_POST){
            $data = I('post.');
            if($data['id']){    //编辑
                $res  = $high_level->where(array('id'=>$data['id']))->save($data);
            }else{              //新增
                $res  = $high_level->add($data);
            }
            if($res !== false){
                $this->success('操作成功',U('lists'));  //跳转到列表页
            }else{
                $this->error('添加失败');
            }
        }else{
            /**id存在是编辑的情况，需要获取高级分类**/
            $map['id']  = $id = I('id',0,'int');
            if($id){
                $high_level = $high_level->where($map)->find(); //查找高级分类
                $this->assign('data',$high_level);
            }
            $this->display();
        }
    }

    /**
     * 单选删除
     */
    public function delete(){
        $map['id']    = $high_id = I('id',0,'int');
        /**查找该高级分类下是否有中级分类，如果有，则不能删除**/
        $middel_level = M('middle_level')->where(array('high_id'=>$high_id))->select();
        if($middel_level){
            $message = '请先删除该高级分类下的中级分类';
            $this->ajaxReturn($message);
        }
        $res = M('high_level')->where($map)->delete();
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
        //判断该高级分类下是否有中级分类
        $where['high_id'] = array('in',$ids);
        $middel_level     = M('middle_level')->where($where)->select();
        if($middel_level){
            $message = '请先删除该高级分类下的中级分类';
            $this->ajaxReturn($message);
        }
        //删除所有选中高级分类
        $map['id']  = array('in',$ids);
        if(M('high_level')->where($map)->delete()){
            $message = '删除成功';
        }else {
            $message = '删除失败';
        }
        $this->ajaxReturn($message);
    }


}