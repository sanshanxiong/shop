<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2017/2/9
 * Time: 9:45
 */

class CookieCart
{
    private $allGoods;

   /* 这个函数并一定是能用上的，当cookie数据有英文时考虑用这样的函数
    function mb_unserialize($serial_str) {
        $out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );
        return unserialize($out);
    }*/


    public function  __construct()
    {

        $cart = isset($_COOKIE['ShoppingCart'])?$_COOKIE['ShoppingCart']:null;

        if($cart!=null) {
            $this->goods= unserialize($_COOKIE['ShoppingCart']);
        }
        else
            $this->goods=false;

    }
    private  function find($id)
    {
        for($i=0;$i<count($this->goods);$i++)
        {

            if($this->goods[$i]['goodsid']==$id) //strval 需要用吗 为什么不需要
            {

                return $i;
            }
        }

        return false;
    }

    //add  one $goods
    public function add($id,$count=1)
    {

        if($this->goods!==false)//cookie购物车中已经有数据
        {
            $index = $this->find($id);//查找cookie购物车中是否有此id的商品
            /* echo '<pre>';
             var_dump($this->allGoods());
             echo '</pre>';
             echo 'index is'.$index;*/

            if ($index !== false)  //已经添加过了
            {
                //更改数量
                $this->goods[$index]['count'] = $this->goods[$index]['count'] + $count;

            }

        }
        //如果cookie购物车是空的，或是未找到此id的商品，则需要将其添加进去
        $this->goods[] = ['goodsid' => $id, 'count' => $count];
        //将购物车数据写回到客户端cookie
        setcookie('ShoppingCart', serialize($this->goods), time() + 3600*24, '/');
    }
    public function remove($id,$count=1)
    {

        $index=$this->find($id);

        if($index!==false)
        {

            $this->goods[$index]['count']=$this->goods[$index]['count']-$count;
            if($this->goods[$index]['count']<=0)
                array_splice($this->goods,$index,1);//用unset相应的索引会丢失
            if(count($this->goods)>0)
                setcookie('ShoppingCart',serialize($this->goods),time()+3600*24,'/');
            else
                $this->clear();
        }


    }
    public  function  removeAll($id)
    {
        $index=$this->find($id);
        if($index)
        {
            array_splice($this->goods,$index,1);
            if(count($this->goods)>0)
                setcookie('ShoppingCart',serialize($this->goods),time()+3600*24,'/');
            else
                $this->clear();
        }

    }
    public function  clear()
    {
        unset($this->goods);
        unset($_COOKIE['ShoppingCart']);
        setcookie('ShoppingCart','',time()-120,'/');

    }
    public function set($id,$count)
    {
        $index=$this->find($id);

        if($index)
        {
            $this->goods[$index]['count']=$count;
            setcookie('ShoppingCart',serialize($this->goods),time()+3600*24,'/');
        }

    }
    public function allGoods()
    {
        return $this->goods;
    }
}
class DBCart
{

    private $model;
    private $userid;
    public function  __construct()
    {
        $this->model=new CartModel();
        $this->userid=$_SESSION['curUser']['id'];

        $cookieCart=new CookieCart();
        if($cookieCart->allGoods())
            $this->writeCookieToDb($cookieCart);
    }
    private function  writeCookieToDb($cookieCart)
    {
        $allGoods=$cookieCart->allGoods();
        foreach($allGoods as $item)
        {
            $this->add($item['goodsid'],$item['count']);

        }
        $cookieCart->clear();
    }
    //add  one $goods
    public function add($id,$count=1)
    {
        $goods=$this->model->select(['goodsid'=>$id,'userid'=>$this->userid]);
        if($goods)
        {
            $goods['count']=$goods['count']+$count;
            return $this->model->update($goods,$goods['id']);
        }
        else
            return $this->model->add(['userid'=>$this->userid,'goodsid'=>$id,'count'=>$count]);

    }
    public function remove($id,$count=1)
    {

        $goods=$this->model->select(['userid'=>$this->userid,'goodsid'=>$id]);
        if($goods['count']>$count)
        {
            $goods['count']=$goods['count']-$count;
            return $this->model->update($goods,$goods['id']);
        }
        else
        {
            return $this->removeAll($id);
        }

    }
    public  function  removeAll($id)
    {
        return $this->model->delete(['userid'=>$this->userid,'goodsid'=>$id]);
    }
    public function  clear()
    {
        return $this->model->delete(['userid'=>$this->userid]);
    }
    public function set($id,$count)
    {
        return $this->model->update(['userid'=>$this->userid,'goodsid'=>$id,'count'=>$count]);
    }
    public function allGoods()
    {

        return $this->model->query();
    }
}
class CartModel extends Model{

}
class CartManager
{
    private $model;
    public function  __construct()
    {
        /*var_dump($_SESSION);*/
        if(isset($_SESSION['uid']))
        {
            $this->model=new DBCart();

        }
        else
        {
            $this->model=new CookieCart();

        }

    }

    //add  one $goods
    public function add($id,$count=1)
    {
        $this->model->add($id,$count);
    }
    public function set($id,$count)
    {
        $this->model->set($id,$count);
    }
    public function remove($id,$count=1)
    {
       $this->model->remove($id,$count);
    }
    public  function  removeAll($id)
    {
       $this->model->removeAll($id);
    }
    public function  clear()
    {
       $this->model->clear();
    }
/*
 * 返回值
 * 1.当没有找到shoppingCart cookie时，返回['allGoods'=>null,'totalPrice'=>0,'totalCount'=>0];
 * 2.若登陆状态，则返回数据库中购物车中的数据，若此用户无购物车信息，则返回['allGoods'=>null,'totalPrice'=>0,'totalCount'=>0];
 *                                         否则返回正常的此格式数据
 * 3.若未登录，能找到shoppingCart cookie时，返回此格式的合法数据
 * */
    public function allGoods()
    {
        /*var_dump($this->model->allGoods());*/
        $tmpGoods=$this->model->allGoods();

         if($tmpGoods==false)
             return ['allGoods'=>null,'totalPrice'=>0,'totalCount'=>0];
         $allGoods=[];
         $bookModel=new BookModel();
         foreach($tmpGoods as $item)
         {
             $goods =$bookModel->select(['id'=>$item['goodsid']]);
             $allGoods[]=['id'=>$goods['id'],'name'=>$goods['name'],'price'=>$goods['price'],'count'=>$item['count']];
         }
        $totalPrice=0;
        $totalCount=0;
        foreach($allGoods as $item)
        {
            $totalPrice=$totalPrice+$item['price']*$item['count'];
            $totalCount=$totalCount+$item['count'];
        }
        return ['allGoods'=>$allGoods,'totalPrice'=>$totalPrice,'totalCount'=>$totalCount];
    }
}