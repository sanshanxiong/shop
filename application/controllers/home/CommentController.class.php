<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2017/2/24
 * Time: 21:05
 */
class CommentController extends Controller
{
    public function  add($id=null)
    {
        $model = $this->getModel();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $data=LinkHelper::getPageInfo("ALL","page1",3);
            $pagerData=['pageIndex'=>$data['pageIndex'],'pageSize'=>$data['pageSize'],'pageCount'=>3];//pageCount 是一共有多少页
            $this->assign('bookid',$id);
            $msgs = $model->allMsg();
            $this->assign('model',['msgs'=>$msgs,'pagerData'=>$pagerData]);
            $this->renderPartial('add');
        }
        else
        {
              $comment = $_POST['comment'];
            $bookid = $_POST['bookid'];
            $user_id = $_SESSION["curUser"]['id'];
            $model->add(['bookid'=>$bookid,'msg'=>$comment,'userid'=>$user_id]);
            $this->redirectToAction('all');
        }
    }
   //for ajax
    public function all($category="ALL",$page="page1")
    {
        $data=LinkHelper::getPageInfo($category,$page,3);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->redirectToUrl(LinkHelper::createLinkURL() . "/page" . $data["pageIndex"]);
            return;
        }
        /*Get请求 点击页码连接转向新的页面*/
        $model=$this->getModel();
        $pagerData=['pageIndex'=>$data['pageIndex'],'pageSize'=>$data['pageSize'],'pageCount'=>3];//pageCount 是一共有多少页
        $msgs=$model->pageMsg($pagerData);
       /* $this->assign("books",$books);
        $this->assign("pagerData",$pagerData);*/
        $result=['msgs'=>$msgs,'pagerData'=>$pagerData];
        echo  json_encode($result);
    }
}