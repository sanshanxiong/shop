<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2016/12/23
 * Time: 18:05
 */
class UserModel extends  Model
{

    public function getAccount()
    {
        $id=$_SESSION['curUser']['id'];
        $user=$this->select(['id'=>$id]);
        return $user['account'];

        //return $_SESSION['curUser']['account'];
    }
    public function  saveAccount($num)
    {
        $id=$_SESSION['curUser']['id'];
        $user=$this->select(['id'=>$id]);
        $oldAccount=$user['account'];
        return $this->update(['account'=>floatval($num)+floatval($oldAccount)],$id);
    }

}