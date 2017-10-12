<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2016/12/25
 * Time: 15:54
 */
class LinkHelper
{
   /* public static function createLink($resource=null)
    {
        if(!isset($resource))
            echo "";
        $urlpath=ROOT_URL.$resource;
        $link=<<<endEof
           <script src="%s"></script>
endEof;
        echo sprintf($link,$urlpath);

    }*/
    public static function createLinkURL($action=CUR_ACTION,$controller=CUR_CONTROLLER,$platform=CUR_PLATFORM)
 {
    /*if(!empty($data))
    {
        $queryArry=[];
        foreach($data as $key=>$value)
        {
            $queryArry[]=$key."=".$value;
        }
        $queryStr="?".implode("&",$queryArry);
        return ROOT_URL.$platform."/".$controller."/".$action.$queryStr;
    } */
     return ROOT_URL.$platform."/".$controller."/".$action;

 }
    public static function getPageInfo($category,$page,$pageSize=10)
    {

        /* Post */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pageIndex = $_POST['pageNow'];
            $category_id = $_POST['category_id'];
            $pageCount = $_POST['pageCount'];
            //header("Location:".LinkHelper::createLinkURL()."/$category_id/page".$pageIndex);
            /*如果输入的页码大于总页数*/
            if ($pageIndex >= $pageCount)
                $pageIndex = $pageCount;
            /* 如果查看的是某个分类下的某页 */
            return  ['pageIndex'=>$pageIndex,'category_id'=>$category_id];

        }
        /*Get请求*/


            if(substr($category,0,9)=='category-')
            {
                $category_id =  substr($category, 9);
            }
            else
                $category_id=$category;//没有用ALL这种进行修饰，例如前台的分类显示页面

            if ($category_id == "ALL")//if($category_id=="ALL")
                $condition = null;
            else
                $condition=['category_id'=>$category_id];
            $pageIndex=substr($page,4);

       return  ['pageIndex'=>$pageIndex,'pageSize'=>$pageSize ,'category_id'=>$category_id,'condition'=>$condition];
    }
    public static function PagerArea($pagerData,$category_id="ALL")
    {
        if($pagerData['pageCount']<=0)
            return;
        $pageHtml=<<<Eof
        <ul class="pager">
          <li class=" %s"><a href="%s" >&larr; Pre</a></li>
          <li class=" %s"><a href="%s">Next &rarr;</a></li>

          <li>
          <form  action="%s" style="display: inline" method="post">
                <input type="text" name="pageNow">
                <input type="submit" value="GO">
                <input type="hidden" name="category_id" value='%s'>
                <input type="hidden" name="pageCount" value='%s'>
                </form>
           </li>
            <li  > 当前页%s/共%s页 </li>

        </ul>


Eof;

        $preDisabled="disabled";
        $nextDisabled="disabled";

        //说明：由于翻页一般是针对当前当前action的进行的，所以 这里creatLinkURL()一般就不需要参数了，但是特殊情况下可能会出问题

        $preUrl=LinkHelper::createLinkURL()."/category-$category_id/".'page'.($pagerData['pageIndex']-1);
        $nextUrl=LinkHelper::createLinkURL()."/category-$category_id/".'page'.($pagerData['pageIndex']+1);
        $formpostUrl=LinkHelper::createLinkURL();
        if ($pagerData['pageIndex']==1)
        {
            $preUrl="";
        }
        if($pagerData['pageIndex']>=$pagerData['pageCount'])
        {
            $nextUrl="";
        }
        if ($pagerData['pageIndex']>1)
        {
            $preDisabled="";

        }
        if($pagerData['pageIndex']<$pagerData['pageCount'])
        {
            $nextDisabled="";

        }
        echo sprintf($pageHtml,$preDisabled,$preUrl,$nextDisabled,$nextUrl ,
            $formpostUrl,$category_id,$pagerData['pageCount'],$pagerData['pageIndex'],$pagerData['pageCount']);


    }
    /*
     *  如果要对所有的数据（不区分类别）进行显示，则第二个参数可以省略，默认为ALL
     * */
    public static function PagerAreafront($pagerData,$category_id="ALL")
    {
        if($pagerData['pageCount']<=0)
        return;
        $pageHtml=<<<END
           <div class="pagination">
            <span class="%s">%s</span>
            <span class="%s" >%s</span>
            <span>
            <form  action="%s" style="display: inline" method="post">
                <input type="text" name="pageNow">
                <input type="submit" value="GO">
                <input type="hidden" name="category_id" value='%s'>
                <input type="hidden" name="pageCount" value='%s'>
                </form>
            </span>
            <span> 当前页%s/共%s页</span>
            </div>
END;
        $firstA=<<<FIRST
              <a href="%s"><<</a>
FIRST;
        $lastA=<<<LAST
             <a href="%s">>></a>
LAST;

        $preDisabled="disabled";
        $nextDisabled="disabled";

        //说明：由于翻页一般是针对当前当前action的进行的，所以 这里creatLinkURL()一般就不需要参数了，但是特殊情况下可能会出问题
           $preUrl=LinkHelper::createLinkURL()."/category-$category_id/".'page'.($pagerData['pageIndex']-1);
           $nextUrl=LinkHelper::createLinkURL()."/category-$category_id/".'page'.($pagerData['pageIndex']+1);


        $formpostUrl=LinkHelper::createLinkURL();
        if ($pagerData['pageIndex']==1)
        {
            $preUrl="";
            $firstA="<<";
            $lastA=sprintf($lastA,$nextUrl);
        }
       else if($pagerData['pageIndex']>=$pagerData['pageCount'])
        {
            $nextUrl="";
            $lastA=">>";
            $firstA=sprintf($firstA,$preUrl);
        }
        else
        {
            $firstA=sprintf($firstA,$preUrl);
            $lastA=sprintf($lastA,$nextUrl);
        }

        if ($pagerData['pageIndex']>1)
        {
            $preDisabled="";

        }
        if($pagerData['pageIndex']<$pagerData['pageCount'])
        {
            $nextDisabled="";

        }

        echo sprintf($pageHtml,$preDisabled,$firstA,$nextDisabled,$lastA,
            $formpostUrl,$category_id,$pagerData['pageCount'],$pagerData['pageIndex'],$pagerData['pageCount']);


    }
}

