<?php

/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2016/12/21
 * Time: 9:18
 */
class View
{

    private $data=[];
    public function assign($key,$value){
        $this->data[$key]=$value;
    }

    public function renderPartial($viewName)
    {


        extract($this->data);
        $contentView=View_PATH.CUR_PLATFORM.DS.CUR_CONTROLLER.DS.$viewName.".php";
        if(file_exists($contentView))
        {
                include  $contentView;
         }

    }
    public function render($viewName=null,$Layoutflag){
        header('Content-Type:text/html;charset=utf-8');
        //var_dump($this->data);
        extract($this->data);
        if($Layoutflag)
        {
            $header=View_PATH.CUR_PLATFORM.DS.CUR_CONTROLLER.DS."header.php";
            $header_default=View_PATH.CUR_PLATFORM.DS."header.php";

            if(file_exists($header))
            {
                include $header;
            }
            else if(file_exists($header_default))
                include $header_default;
        }
        if(!isset($viewName))
        {
            $contentView=View_PATH.CUR_PLATFORM.DS.CUR_CONTROLLER.DS.CUR_ACTION.".php";
            if(file_exists($contentView))
            {
                include $contentView;
            }
        }
        else
        {
            $contentView=View_PATH.CUR_PLATFORM.DS.CUR_CONTROLLER.DS.$viewName.".php";
            if(file_exists($contentView))
            {
                include $contentView;
            }

        }


        if($Layoutflag)
        {
            $footer=View_PATH.CUR_PLATFORM.CUR_CONTROLLER.DS."footer.php";
            $footer_default=View_PATH.CUR_PLATFORM.DS."footer.php";

            if(file_exists($footer))
                include $footer;
            else if(file_exists($footer_default))
                include $footer_default;
        }

    }
}