<?php
/**
 * Created by PhpStorm.
 * User : Leopard
 * Date : 2018/6/29
 * Time : 10:55
 * Email: 417780879@qq.com
 */
namespace app\common\qiniu;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use think\Controller;
use think\Request;

class QiuniuUpload extends Controller
{
    //  1.composer require qiniu/php-sdk
    public function qiniuUpload(Request $request){
        $ak='3iXgIHkHxgtthbA2Tmr9oA3RgSYNyonrd4gPiDCC';
        $sk='7I3mbVBg-Q29cO3gVS4CMSbhpykSQqormPZ_BiX9';
        $bucket = 'wutongshu';
        $auth=new Auth($ak,$sk);
        $token = $auth->uploadToken($bucket);
        if($request->isPost()){
            $data=$_FILES['pic']['tmp_name'];
            $filePath = $data;
            // 上传到七牛后保存的文件名
            $key = 'my-test.png';
            // 初始化 UploadManager 对象并进行文件的上传。
            $uploadMgr = new UploadManager();
            // 调用 UploadManager 的 putFile 方法进行文件的上传。
            list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
            if ($err !== null) {
                var_dump($err);
            } else {
                var_dump($ret);
            }
        }
    }
}