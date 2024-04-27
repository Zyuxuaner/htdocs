<?php
namespace app\index\controller; //指出该文件的位置
use think\Controller;   //用于向V层进行数据的传递
use app\common\model\News;   //新闻模型
use think\Request;  //引用Request
use think\Db;

/**
 * 新闻模块，继承think\Controller类后，利用V层对数据进行打包上传
 */
class NewsController extends Controller 
{
    public function add()
    {
        return $this->fetch();
    }
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

    public function insert()
    {
        $file = request()->file('file');
       
        if ($file) 
        {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) 
            {
                //获取文件描述信息即文件标题
                $description = request()->post('Description');
                //获取文件上传日期
                $uploadDate = request()->post('UploadDate');
                // 获取保存的文件名
                $fileName = $info->getSaveName();                
                // 获取文件扩展名
                $fileExtension = $info->getExtension();  
                $news = new News();
                $data = [
                    'NewsName' => $fileName,
                    'NewsPath' => $info->getPathname(),
                    'Description' => $description,
                    'Extension' => $fileExtension,
                    'UploadDate' => $uploadDate,
                ];
                $saveResult = $news->save($data);             
                if ($saveResult) 
                {
                    // 保存成功
                    return '文件上传并保存成功！';
                } else 
                {
                    // 保存失败
                    return '文件上传失败，保存数据库时出错！';
                }
            } else 
            {
                // 文件移动失败，输出错误信息
                return '文件移动失败';
            }
        } else 
        {
            // 没有上传文件
            return '没有文件被上传！';
        }
        //return $this->fetch();
    }
    public function upload() {
        $news = News::select();
        $this->assign('news', $news);
        return $this->fetch();
        
    }
}