<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2016/12/27
 * Time: 20:41
 */
class CategoryController extends  Controller
{
    /* 此方法已经被挪到了controller类的构造方法里
     * public function validateUserState()
    {
        if(!$this->isValidUser())
        {
            header("Location:".LinkHelper::createLinkURL("login","User")."/RETURNURL=".LinkHelper::createLinkURL());

        }
    }*/
    /*
     * 上面的方法代替了下面的方法，因为下面的写法更麻烦
     public function   __construct($controller_name)
    {
        parent::__construct($controller_name);
        if(!$this->isValidUser())
        {
            $this->redirectToAction("login","User");

        }

    }*/
    protected function index()
    {
        //$model=new CategoryModel();
        $model=$this->getModel();
        $categories=$model->query();

        $this->assign("title","List of all Categories");

        $this->assign("categories",$categories);
        $this->render();
    }
    protected function add()
    {
        if($_SERVER["REQUEST_METHOD"]=='POST')
        {
            //var_dump($_POST);die();
            $category_name = $_POST['category_name'];

            //$model=new BookModel();
            $model=$this->getModel();
            $model->add(["category_name"=>$category_name ]);
            $this->redirect("index");
        }
        else
        {
            $this->render();
        }
    }
    protected function all($page="page1")
    {

        if(empty($page))
            $pageIndex=1;
        else
            $pageIndex=substr($page,4);
        //$model=new BookModel();
        $model=$this->getModel();
        $pagerData=['pageIndex'=>$pageIndex,'pageSize'=>3,'pageCount'=>0];
        $books=$model->queryPage($pagerData);
        $this->assign("title","List of all categories");
        // var_dump($books);
        $this->assign("categories",$books);
        $this->assign("pagerData",$pagerData);
        $this->render();
    }


    protected function update($id)
    {
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $name=$_POST["name"];

            $id=$_POST["id"]; //这样也可以，同时由于路由没有变，用路由参数也可以
            //$model=new BookModel();
            $model=$this->getModel();
            $model->update(["category_name"=>$name],$id /*$data[0]*/);
            $this->redirect("index");
        }
        else
        {
            $model=$this->getModel();
            //$model=new BookModel();
            $category=$model->select(['id'=>$id]);
            $this->assign("category",$category);

            $this->render();
        }
    }
    protected function delete($id)
    {
        $model=$this->getModel();
        //$model=new CategoryModel();
        $model->delete(["id"=>$id]);
        $this->redirect("index");
    }

}