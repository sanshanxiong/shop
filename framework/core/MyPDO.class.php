<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2016/12/21
 * Time: 15:30
 */

class MyPDO
{
    private  $pdo;
    public function __construct()
    {
        $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
        $user=DB_USER;
        $password=DB_PASSWORD;
        $this->pdo=new PDO($dsn,$user,$password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("set names utf8");
    }
    //如果成功，PDO::query()返回PDOStatement对象，如果失败返回 FALSE 。
    public function queryOne($sql,$data)
    {
           if(isset($data))
           {
               $stmt=$this->pdo->prepare($sql);
               $stmt->execute($data);
           }
        else {
            $stmt=$this->pdo->query($sql);
        }
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result=$stmt->fetch();
        return $result;
    }
    public function queryALL($sql,$data)
    {
        $stmt = $this->pdo->prepare($sql);
        if(isset($data))
        {

            $stmt->execute($data);
        }
        else
        {

            $stmt->execute();
        }

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function nonQuery($sql,$data)
    {
        $stmt=$this->pdo->prepare($sql);
        if (isset($data))
            $stmt->execute($data);
        else
            $stmt->execute();

        return $stmt->rowCount();
    }
}