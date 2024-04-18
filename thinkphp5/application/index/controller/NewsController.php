<?php
namespace app\index\controller; //指出该文件的位置
use think\Controller;   //用于向V层进行数据的传递
use app\common\model\News;   //新闻模型
use think\Request;  //引用Request

/**
 * 新闻模块，继承think\Controller类后，利用V层对数据进行打包上传
 */
class NewsController extends Controller 
{
    public function index()
    {
        $News = new News;
        $newses = $News->select();

        // 向V层传数据
        $this->assign('newses', $newses);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }

}