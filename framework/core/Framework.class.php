<?php
/**
 * 核心启动类
 * User: qcx
 * Date: 2016/12/20
 * Time: 19:43
 */
class Framework{
     public static function  run()
     {
        // echo "running ..";
         self::init();
         self::autoLoad();
         self::autostart();
         self::route();

     }
    public static  function  init()
    {
       //定义路径，获取当前工作路径getcwd()
        define("DS",DIRECTORY_SEPARATOR);
        define('ROOT_PATH',getcwd().DS);
        define("FRAME_PATH",ROOT_PATH."framework".DS);
        define("APP_PATH",ROOT_PATH."application".DS);
        define("PUBLIC_PATH",ROOT_PATH."public".DS);
        define("CONTROLLER_PATH",APP_PATH."controllers".DS);
        define("Model_PATH",APP_PATH."models".DS);
        define("View_PATH",APP_PATH."views".DS);
        define("CONFIG_PATH",ROOT_PATH."config".DS);
        define("CORE_PATH",FRAME_PATH."core".DS);
        define("HELPERS_PATH",FRAME_PATH."helpers".DS);
        //ROOT_URL用来作为静态资源的参考路径！！！
        define("ROOT_URL",rtrim($_SERVER['PHP_SELF'],"index.php"));
        //echo "haha ".$_SERVER['DOCUMENT_ROOT'];
        include CONFIG_PATH."config.php";
    }
    /*public static function route()
    {
       $plateform = isset($_REQUEST['p'])?$_REQUEST['p']:'home';
       $controller = isset($_REQUEST['c'])?$_REQUEST['c']:'Index';
       $action = isset($_REQUEST['a'])?$_REQUEST['a']:'index';
        define('CUR_PLATFORM',$plateform);
        define('CUR_CONTROLLER',ucfirst($controller));
        define('CUR_ACTION',$action);
    }*/
    public static function route()
    {
        if(!empty($_GET['url']))
        {
            $url=$_GET['url'];
            $url=rtrim($url,"/");//去除类似a/b/c/这样的最后一个斜线，否则会有一个空字符串“”数据
           $urlArray=explode('/',$url);
           $plateform=isset($urlArray[0])?strtolower($urlArray[0]):"admin";
           array_shift($urlArray);
           $controller=isset($urlArray[0])?ucfirst(strtolower($urlArray[0])):"Book";
           array_shift($urlArray);
           $action=isset($urlArray[0])?strtolower($urlArray[0]):"index";

           array_shift($urlArray);
           $urlString=isset($urlArray)?$urlArray:[];


        }
        else
        {
            $plateform="admin";
            $controller="Book";
            $action="index";
            $urlString=[];
        }

        define('CUR_PLATFORM',$plateform);
        define('CUR_CONTROLLER',ucfirst($controller));
        define('CUR_ACTION',$action);

        $controller_name=CUR_CONTROLLER."Controller";
        $action_name=CUR_ACTION;
        /*
        $c=new $controller_name(CUR_CONTROLLER);
        $c->$action_name($urlString);
        */
        $dispatch = new $controller_name(CUR_CONTROLLER);

        // 如果控制器存和动作存在，这调用并传入URL参数
        if ((int)method_exists($controller_name, $action_name)) {

            call_user_func_array(array($dispatch, $action_name), $urlString);
        } else {
            exit($controller_name . "控制器不存在");
        }

    }
    public static function autoLoad()
    {
        spl_autoload_register([__CLASS__,'loader']);
    }
    private  static  function loader($className)
    {

         $controller_path=CONTROLLER_PATH.CUR_PLATFORM.DS.ucfirst($className).'.class.php';
         $model_path=Model_PATH.ucfirst($className).'.class.php';
        $corePath=CORE_PATH.$className.".class.php";
        $helpersPath=HELPERS_PATH.$className.".class.php";

       // echo $controllerPath."<br/>";
        //echo $modelPath."<br/>";
        if(file_exists($controller_path))
             {
             include $controller_path;

         }else if(file_exists($model_path))
         {
             include $model_path;

         }
        else  if(file_exists($corePath))
        {

            include CORE_PATH.$className.".class.php";

        }
        else  if(file_exists($helpersPath))
        {
            include HELPERS_PATH.$className.".class.php";
        }

    }
    private static function  loadCurLCookie()
    {
        if(isset($_COOKIE['curl']))
        {

            foreach($_COOKIE as $key=>$value)
            {
                $_COOKIE[$key]=urldecode($value);
            }

        }
    }
    public static function  autostart()
    {


        session_start();
        self::loadCurLCookie();
        setcookie('PHPSESSID', session_id(), time()+60*60,'/');//设置回话的有效期
    }
}
