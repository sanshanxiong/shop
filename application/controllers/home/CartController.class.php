<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2017/2/9
 * Time: 9:43
 */
class CartController extends  Controller
{
    public  function index()
    {
        //echo $_COOKIE['ShoppingCart'];
        $model=new CartManager();
        $cart=$model->allGoods();

        $this->assign('cart',$cart);
        $this->render();
    }
    public function add($id)
    {

        $model=new CartManager();
        $model->add($id);
        /*echo '<pre>';
        var_dump($model->allGoods());
        echo '</pre>';
        die();*/
        $this->redirectToAction('index');
    }
    public function cartinfo()
    {


        $model=new CartManager();
         $cart=$model->allGoods();

        $this->assign('cart',$cart);
        $this->renderPartial('cartinfo');

    }
    public function  info()
    {

        $model=new CartManager();
        $cart=$model->allGoods();
       /* var_dump($cart);
        die();*/
        $this->assign('cart',$cart);
        $this->renderPartial('info');
    }
    public function  remove($id)
    {

        $model=new CartManager();
        $model->remove($id);

        /*var_dump($model->allGoods());
        echo '</pre>';
        die();*/
        $this->redirectToAction('index');
    }


}