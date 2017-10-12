<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2016/12/23
 * Time: 18:04
 */
class UserController extends Controller
{
    /*
     * Controller类实现了默认的用户身份验证，并在Controller类的构造方法中调用
     * Controller的子类不需要任何的代码，所有的action都会约束于此验证
     * 对于Usercontroller这种部分action需要受约于验证，部分必须开放（如login）,步骤如下
     * （步骤一）重写父类的validateUserState()方法，设置内容为空
     * （步骤二）在需要验证约束的action开头使用 parent::validateUserState();方法。然后再调用其它方法。
     * 如果某个controoler需要完全不需要验证约束，则只要重写父类的validateUserState()方法，设置内容为空
     *
     * 实现身份验证还可以使用下面的方法
     * 步骤一:不再使用validateUserState()方法，而是在Controller中定义__call方法，方法里调用验证代码，再动态调用函数
     * 步骤二：各个Controller子类的action，需要验证的定义为protected,不需要验证的定义为public 则可以。
     * */

   /* public function validateUserState()
    {
          //为了避免循环redirect,所以这个类的validateUserState方法设置为空，从而避免进入本
        //controller同样要验证。（这是由于login的关系）。
    }*/
    public function  login()
    {
        //do Get
        if (!$this->isPostRequest())
        {
            //方法1 这是我最终的方法
            $args=func_get_args();//获得url中匹配p,c,a之后的其它的数据构成的数组（之前根据/被拆开
            if(count($args)>0)
            {
                $args[0]="";//去掉 RETURNURL=
                $returnUrl=implode('/',$args);
            }
            else
                $returnUrl='';

            //方法2 这是方法1之前想到的方法
           /*
            $pos=strpos($_GET['url'],"RETURNURL");
            $returnUrl=substr($_GET["url"],$pos+10);
           */

            //方法3 这种方法是最初的方法 ，但是是错误的。不成功redirect 这里从referer取不到来的URL
           /*
            $this->assign("returnUrl",isset($_SERVER["HTTP_REFERER"])? $_SERVER["HTTP_REFERER"]:"");
           */
            if(isset($_COOKIE["uid"]))
                $userinfo=$_COOKIE["uid"];
            else $userinfo="";
            $arry=explode('|',$userinfo);
            if(count($arry)>1)
            {
                $username=$arry[0];
                $password=$arry[1];

            }
            else
            {
                $username=$arry[0];
                $password='';
            }
            $this->assign("returnUrl", $returnUrl);
            $this->assign("msg","");
            $this->assign("username",$username);
            $this->assign("password",$password);
            $this->render("login",false);
            return;
        }
        //do Post
        $username=$_POST["username"];
        $password=$_POST["password"];
        $remember=isset($_POST["remember"])?$_POST["remember"]:false;
        $returnUrl=$_POST["returnUrl"];
        $model = $this->getModel();
        $user=$model->select(["name"=>$username,"password"=>$password]);

        if($user)
        {
            //search in database

            $_SESSION["uid"]=$username;
            $_SESSION["curUser"]=$user;
            if($remember=='remember')
               setcookie("uid",$username.'|'.$user['password'],time()+3600,'/');
            else
                setcookie("uid",$username,time()+3600,'/');
            if($returnUrl!="")
                $this->redirectToUrl($returnUrl);
            else
                $this->redirectToAction("index","book","admin");
        }
        else
        {

            $msg='用户名或密码错误！';
            $this->assign("msg",$msg);
            $this->assign("username",$username);
            $this->assign("password",$password);
            $this->assign("returnUrl", $returnUrl);
            $this->render('login',false);
        }
    }
    public  function  logout()
    {
        session_destroy();

        $_SESSION=[];
        $this->redirectToAction('login','user');
    }
    /*
     * userInfo userLikes 采用两种用户验证方式，只是为了留下样例。
     */
    public function userInfo()
    {

        parent::validateUserState();
        $this->assign('title',"About Me");
        $user=$_SESSION['curUser'];
        $this->assign('user',$user);
        $this->render();
    }
    protected function  deposit()
    {
       if(!$this->isPostRequest())
       {
           $model =$this->getModel();
           $this->assign('money',$model->getAccount());
           $this->assign('msg','');
           $this->assign("returnUrl",$_SERVER["HTTP_REFERER"]);
           $this->render();
       }
        else
        {
            $money=$_POST['num'];
            $model =$this->getModel();
            $returnUrl=$_POST['returnUrl'];
            $flag=$model->saveAccount($money) ;
            $this->assign("money",$model->getAccount());
            $this->assign("returnUrl",$returnUrl);
            $this->assign('msg',$flag==true?"充值成功！" :"充值失败");
            $this->render();
        }
    }
    protected function userLikes()
    {


        echo "user likes";
    }
    protected  function all()
    {
       $model = $this->getModel();
       $users = $model->query();

       $this->assign('users',$users);
       $this->assign('levels',['管理员'=>2,'普通用户'=>0,'Vip用户'=>1]);
       $this->render();
    }
    protected  function  delete($id)
    {
        $model= $this->getModel();
        $model->delete(["id"=>$id]);
        //$this->redirectToAction('all');
        $this->redirectToActionWithMsg("删除成功！",'all');
    }
    protected  function  update()
    {
        $id=$_POST["id"];
        $level=$_POST["level"];
        $model = $this->getModel();
         $model->update(['level'=>$level],$id);
        $this->redirectToActionWithMsg("更新成功！",'all');
    }

}