<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        $data=Db::table('user')->select();
        $this->assign("data",$data);
        return view('show');
    }
}
