<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2016/12/20
 * Time: 21:38
 */
class Controller{
    protected  $view;
    //const LINK_URL=ROOT_URL.CUR_PLATFORM."/".CUR_CONTROLLER."/";
     private  $_model;
    public function  __construct($controller_name){
        $this->view= new View();
        $model_name=$controller_name."Model";
        $this->_model =new  $model_name();
        //$this->assign("LINK_URL",  self::LINK_URL) ;静态的属性要养self，即和类有关的用self

        //This is used to check if user has log in
       // $this->validateUserState();
    }
    public function getModel()
    {
        return $this->_model;
    }
    public function  assign($key,$value)
    {
        $this->view->assign($key,$value);
    }
    public function render($viewName=null,$flag=true)
    {
        $this->view->render($viewName,$flag);

    }
      public function renderPartial($viewName)
    {
        $this->view->renderPartial($viewName);

    }
    public function isValidUser(){
        if(isset($_SESSION["uid"]))
            return true;
        else
            return false;
    }

    public function validateUserState()
    {
        //这个方法在父类定义的方法名并在构造方法中调用。父类中方法可以定义为空的，然后将此方法放到子类中
        //这里将其放到父类，则子类就省事了
        //如果子类需要登录用户才能访问controll，则其需要实现此方法，但是不需要调用（因为父类框架中已经调用）

        if(!$this->isValidUser())
        {
            //echo "Test:".LinkHelper::createLinkURL("login","User")."/RETURNURL=".LinkHelper::createLinkURL();
            header("Location:".LinkHelper::createLinkURL("login","User")."/RETURNURL=".LinkHelper::createLinkURL());

        }
    }
    public function  isPostRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            return true;
        else
            return false;
    }
    public function redirectToAction($actionName,$controllerName=CUR_CONTROLLER,$platform=CUR_PLATFORM )
    {
        header("Location:".LinkHelper::createLinkURL($actionName,$controllerName,$platform));
        //确保重定向后，后续代码不会被执行
        exit;
    }
    public function  redirectToActionWithMsg($msg,$actionName,$controllerName=CUR_CONTROLLER,$platform=CUR_PLATFORM )
    {
      $html =   <<<Eof
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
<meta http-equiv="refresh" content="1;url=%s">
</head>
<body>
<h2>%s</h2>
</body>
</html>

Eof;
   $html=sprintf($html,LinkHelper::createLinkURL($actionName),$msg);
   echo $html;
    }
    public function redirectToUrl($url)
    {


        header("Location:".$url);
        //确保重定向后，后续代码不会被执行
        exit;
    }
    public function __call($method,$args)
    {


        $this->validateUserState();

        return call_user_func_array([$this, $method], $args);
    }
}