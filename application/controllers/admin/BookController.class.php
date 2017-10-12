<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2016/12/20
 * Time: 20:58
 */
class BookController extends  Controller{


    protected function index()
    {
        //$model=new BookModel();

        $model=$this->getModel();
        $books=$model->query();

        $this->assign("title","List of all books");

        $this->assign("books",$books);
        $this->render();

    }
    /*
     * 查询某一个分类下的某一页的所有物品
     * */
    protected function all($category="category-ALL",$page="page1")
    {
        $data=LinkHelper::getPageInfo($category,$page,2);

        /* Post 输入页码跳转到某一页*/
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->redirectToUrl(LinkHelper::createLinkURL() . "/category-".$data['category_id']."/page" . $data["pageIndex"]);
        }
        /*Get请求 点击页码连接转向新的页面*/
        $model=$this->getModel();
        $pagerData=['pageIndex'=>$data['pageIndex'],'pageSize'=>$data['pageSize'],'pageCount'=>0];//pageCount 是一共有多少页

        $books=$model->queryPage($pagerData,$data['condition']);

        $cateModel = new CategoryModel();
        $categories=$cateModel->query();

        $this->assign("category_id",$data['category_id']);
        $this->assign("categories",$categories);
        $this->assign("books",$books);
        $this->assign("pagerData",$pagerData);
        $this->render();
    }
    protected function  show($id)
    {

        $model= $this->getModel();
       $book = $model->select(['id'=>$id]);
       if(isset($book))
       {
           $this->assign("book",$book);
           $this->render();
       }
        else
        {
            $this->assign("msg","No Book was fond!");
            $this->render("error");
        }
    }
    protected  function uploadFile()
    {

            if ($_FILES["file"]["error"] > 0)
            {
                echo "Error: " . $_FILES["file"]["error"] . "<br />";
                //$this->assign("errorMsg",$_FILES["file"]["error"]);
            }
            else
            {
                echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                echo "Type: " . $_FILES["file"]["type"] . "<br />";
                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                echo "Stored in: " . $_FILES["file"]["tmp_name"];
                die();
                if (file_exists(PUBLIC_PATH."uploads".DS.$_FILES["file"]["name"]))
                {
                    echo $_FILES["file"]["name"] . " already exists. ";
                }
                else
                {
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        PUBLIC_PATH."uploads".DS.$_FILES["file"]["name"]);
                    echo "Stored in: " . "uploads/" . $_FILES["file"]["name"];
                }
            }

        die();
    }
    protected function add()
    {
        if($_SERVER["REQUEST_METHOD"]=='POST')
        {
            //var_dump($_POST);die();
            $bookname = $_POST['name'];
            $price = $_POST['price'];
            $count = $_POST['count'];
            $category_id=$_POST["category_id"];
            $content=$_POST["content"];
            //$this->uploadFile();
            $obj=new ImageHelper($_FILES["file"]);
            $obj->uploadImage();
            $obj->printInfo();

            //$model=new BookModel();
            $model=$this->getModel();
            $model->add(["name"=>$bookname,"price"=>$price,"count"=>$count,"content"=>$content,"category_id"=>$category_id]);
            if(isset($_POST["returnUrl"]) )
                //header("Location:".$_POST["returnUrl"]);
               $this->redirectToUrl($_POST["returnUrl"]);
            else
                $this->redirect("index");
        }
       else
       {
           $this->assign("returnUrl",$_SERVER["HTTP_REFERER"]);//非常重要
           $categoryModel=new CategoryModel();
           $categories=$categoryModel->query();
           $this->assign("categories",$categories);
           $this->render();
       }
    }
    protected function update($id)
    {
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $name=$_POST["name"];
            $price=$_POST["price"];
            $count=$_POST["count"];
            $content=$_POST["content"];
            //$id=$_POST["id"]; 这样可以，同时由于路由没有变，用路由参数也可以
            $model=new BookModel();
            $model->update(["name"=>$name,"count"=>$count,"price"=>$price,"content"=>$content],$id);
            //$this->redirect("index");
            //$this->redirect(isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:"index");
            if(isset($_POST["returnUrl"]) )
               //header("Location:".$_POST["returnUrl"]);
               $this->redirectToUrl($_POST["returnUrl"]);
            else
                $this->redirectToAction("index") ;
        }
        else
        {
            //$model=new BookModel();
            $model=$this->getModel();
            $book=$model->select(['id'=>$id]);
            $this->assign("book",$book);
            $this->assign("returnUrl",$_SERVER["HTTP_REFERER"]);
            $categoryModel=new CategoryModel();
            $categories=$categoryModel->query();
            $this->assign("categories",$categories);
            $this->render();
        }
    }
    protected function delete($id)
    {

        //$model=new BookModel();
        $model=$this->getModel();
        $model->delete(["id"=>$id]);
        //$this->redirect("index");
        if(isset($_SERVER["HTTP_REFERER"]) )
            //header("Location:".$_SERVER["HTTP_REFERER"]);
           $this->redirectToUrl($_SERVER["HTTP_REFERER"]);
        else
            $this->redirect("index");
    }

}