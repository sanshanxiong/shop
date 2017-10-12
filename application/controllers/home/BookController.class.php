<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2017/2/5
 * Time: 18:21
 */
class BookController extends  Controller
{
    public function  index()
    {


        $model = $this->getModel();
        $books=$model->query(null,3);
        $newBooks = $model->query(['category_id'=>3],3);

        $this->assign('books',$books);
        $this->assign('newBooks',$newBooks);
        $this->render();
    }
    public function  detail($id)
    {
        $model = $this->getModel();
        $book = $model->select(['id'=>$id]);
        if(!$book)
            $this->redirectToActionWithMsg('未找到此书','index','book');
        else
        {

            $this->assign('book',$book);
            $this->render();
        }

    }
    //partial view  no use,just for test!
    public function stories()
    {
        $model = $this->getModel();
        $books=$model->query(['category_id'=>3]);
        $this->assign('books',$books);
        $this->renderPartial('stories');

    }

    //partial view
    public function promotions()
    {
        $model = $this->getModel();
        $books=$model->query(['category_id'=>4],3);
        $this->assign('books',$books);
        $this->renderPartial('promotions');

    }
    /*
     * 分页使用样例：
     * 适用于需要按照某种类别分页显示数据的情况
     * 参数1:分类id
     * 参数2：当前页码的格式化形式
     * （1）函数中要首先调用LinkHelper::getPageInfo方法，将分类id,当前格式化页码和每页的记录数传递过去
     * （2）若是post请求，说明由跳转到目标页按钮发出，则跳转到相应的页面（实际是对目标页发get请求了）。
     *  （3）若是get请求，则在利用模型，根据指定条件查询数据
     *  （4）交由控制器向视图传递参数、渲染。
     * */
    public function category($id,$page="page1")
    {

        $data=LinkHelper::getPageInfo($id,$page,6);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->redirectToUrl(LinkHelper::createLinkURL() . "/category-".$data['category_id']."/page" . $data["pageIndex"]);
            return;
        }
        /*Get请求 点击页码连接转向新的页面*/
        $model=$this->getModel();
        $pagerData=['pageIndex'=>$data['pageIndex'],'pageSize'=>$data['pageSize'],'pageCount'=>3];//pageCount 是一共有多少页
        $books=$model->queryPage($pagerData,$data['condition']);

        $this->assign("category_id",$data['category_id']);
        $this->assign("books",$books);
        $this->assign("pagerData",$pagerData);

        $c = new CategoryModel();
        $cobj = $c->select(['id'=>$data['condition']['category_id']]);
        $this->assign('categoryName',$cobj['category_name']);

        $this->render();
    }

    public function all($category="ALL",$page="page1")
    {

        $data=LinkHelper::getPageInfo($category,$page,6);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->redirectToUrl(LinkHelper::createLinkURL() . "/page" . $data["pageIndex"]);
            return;
        }
        /*Get请求 点击页码连接转向新的页面*/
        $model=$this->getModel();
        $pagerData=['pageIndex'=>$data['pageIndex'],'pageSize'=>$data['pageSize'],'pageCount'=>3];//pageCount 是一共有多少页
        $books=$model->queryPage($pagerData);
        $this->assign("books",$books);
        $this->assign("pagerData",$pagerData);

        $this->render();
    }
}