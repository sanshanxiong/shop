<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2017/2/24
 * Time: 21:05
 */
class CommentModel extends Model
{
    public function pageMsg($pageData)
    {
        $allmsg= $this->query(null,$count=6);

        for($i=0;$i<count($allmsg);$i++)
        {
            $allmsg[$i]['msgtime']=$this->calTime($allmsg[$i]['msgtime']);
            $allmsg[$i]['username']=$this->findUser($allmsg[$i]['userid']);
        }
        return $allmsg;
    }
    public function allMsg()
   {
      $allmsg= $this->query(null,$count=6);

      for($i=0;$i<count($allmsg);$i++)
      {
          $allmsg[$i]['msgtime']=$this->calTime($allmsg[$i]['msgtime']);
          $allmsg[$i]['username']=$this->findUser($allmsg[$i]['userid']);
      }
       return $allmsg;
   }
    private function  calTime($time)
  {
   // return date('Y-m-d H:i:s', $time);
 return $time;
  }
    private function  findUser($userid)
    {
        $model=new  UserModel();
       $user =$model->select(['id'=>$userid]);
        if($user )
            return $user['name'];

    }
}