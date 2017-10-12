<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2017/2/6
 * Time: 9:09
 */
class HtmlHelper
{
    /*
     * 如果此Action需要cookie或本session，则需要调用这个方法，否则，调用renderAction($url)就可以了
     * 即renderStateAction($url)无论是否需要cookie和session都可以使用
     * */
    public static function  renderStateAction($url)
    {

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"Http://".$_SERVER['HTTP_HOST'].$url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);    //超时时间30s
        /*
         * 如果希望发送的是POST请求，则可以利用以下代码设置请求类型和传递表单数据
          否则发送的是get请求
           $post_data = array (
                    "userid" =>'id',
                    "query" => "Nettuts", //没有用的参数
                    "action" => "Submit" //没有用的参数
                );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
         */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        /*
         * 将$_Cookie中的每个cookie编码后拼接成一个字符串
         */
        $varry=[];
        foreach($_COOKIE as $key => $value)
        {
            $varry[]=$key."=".urlencode($value);
        }
        $varry[]='curl='.urlencode('true');
        $cookie=implode(';',$varry);
        //$cookie='PHPSESSID='.session_id().';ShoppingCart='.$_COOKIE['ShoppingCart'].";"; //这样也可以获取当前的PHPSEEID
        curl_setopt($ch,CURLOPT_COOKIE,$cookie);
        //！！Very important！这里close session非常重要。否则当前的请求会锁住对session的占有，curl_exec想在本请求中再请求session使用，就会被锁住，造成超时，失败。
        session_write_close();
        $output = curl_exec($ch);
        curl_close($ch);
        echo $output;

    }
    public static  function renderAction($url)
    {
         $content=file_get_contents("Http://".$_SERVER['HTTP_HOST'].$url);
        echo $content;

    }
}