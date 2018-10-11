<?php
/**
 * Created by PhpStorm.
 * User: 张新宜
 * Date: 2018/10/7
 * Time: 8:51
 */

namespace app\index\controller;

use think\Controller;
use think\Db;

class Day4 extends Controller
{
    public function index(){
        return view('index');
    }
    public function insert_do(){


        $file = request()->file('image');

        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $post=$_POST;
                $a='uploads/'.$info->getSaveName();
                $post['u_img']= str_replace("\\","/",$a);
                $res=Db::table('user')->insert($post);
                if($res){
                    return $this->success('添加成功','show');
                }else{
                    return $this->error('添加失败');
                }
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }
    public function show(){
        $data=Db::table('user')->paginate(3);
        $page = $data->render();
        $this->assign('data',$data);
        $this->assign('page', $page);
        return $this->fetch('show');
    }
    public function upda(){
        $u_id=$_GET['u_id'];
        $data=Db::table('user')->where("u_id=$u_id")->find();
        $this->assign('data',$data);
        return $this->fetch('upda');
    }
    public function upda_do(){
        $post=$_POST;
        $res=Db::table('user')->update($post);
        if($res){
            return $this->success('修改成功','show');
        }else{
            return $this->error('修改失败','show');
        }
    }
    public function del(){
        $u_id=$_GET['u_id'];
        $res=Db::table('user')->where("u_id=$u_id")->delete();
        if($res){
            return $this->success('删除成功','show');
        }else{
            return $this->error('删除失败','show');
        }
    }
}