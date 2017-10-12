<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2016/12/20
 * Time: 21:38
 */
class Model
{
    private $_table;//表名和model名存在对应关系
    protected $mypdo; //原来是自由的，改成protected,是为了对于条件复杂的查询，子类可以直接使用它。
    protected $model;//model类的名字,但是目前看不出子类要它有什么用
    public function __construct()
    {
        $this->mypdo=new MyPDO();
        $this->model = ucfirst(get_class($this));
        $this->_table=rtrim($this->model,"Model");

    }
    public function add($data)
    {
        //$sql="insert into {$this->_table} ({$this->formatFields($data)} ) values({$this->createValueFields($data)})";
        $sql=sprintf("insert into %s (%s) values (%s)",$this->_table,
        $this->formatFields($data),$this->formatInsertFields($data));
        return  $this->mypdo->nonQuery($sql,$data);
    }
    public function delete($data)
    {
        $sql=sprintf("delete from %s where %s",$this->_table,$this->formatConditionFields($data));
       return  $this->mypdo->nonQuery($sql,$data);
    }
    public function update($data,$id)
    {   $sql=sprintf("update %s set %s  where id=%s",$this->_table,
                   $this->formatUpdateFields($data),$id);

        return $this->mypdo->nonQuery($sql,$data);
    }
    /*
     * select one record
     *
     * */

    public function  select($data)
    {

        $sql=sprintf("select * from %s where %s",$this->_table,
                $this->formatConditionFields($data));
        return $this->mypdo->queryOne($sql,$data);
    }

    public function  query($data=null,$count=null,$orderby=null)
    {
        $sql="";
        if($count==null )
            $countSQL='';
        else
            $countSQL="  limit ".$count;
        if($orderby==null)
            $orderbySQL=' Order by id desc ';
        else
        {
            $orderbySQL="";
            foreach($orderby as $key=>$value)
            {
                $orderbySQL="  ".$key."  ".$value;
            }
            $orderbySQL=' order by '.$orderbySQL;
        }
        if(!isset($data))
        {
          $sql=sprintf("select * from %s  ",$this->_table);
        }
        else
        {
            $sql=sprintf("select * from %s where %s ",$this->_table,
            $this->formatConditionFields($data));
        }
         $sql=$sql.$orderbySQL.$countSQL;

        return $this->mypdo->queryALL($sql,$data);
    }
    //对于其他复杂的执行语句
    public function nonQuery($sql,$data)
    {
        return $this->mypdo->nonQuery($sql,$data);
    }
    // name,age,sex,address
    private function formatFields($data)
    {
        $array=[];
        foreach($data as $key=>$value)
        {
            $array[]=$key;
        }
        $fields= implode(",",$array);
        return $fields;
    }

    //name=:name,age=:age,address=:address
    private function formatUpdateFields($data)
    {
        $array=[];
        foreach($data as $key=>$value)
        {
            $array[]=$key."=:".$key;
        }
        $fields= implode(",",$array);
        return $fields;
    }
    private function formatInsertFields($data)
    {
        $array=[];
        foreach($data as $key=>$value)
        {
            $array[]=":".$key;
        }
        $fields= implode(",",$array);
        return $fields;
    }
    private function formatConditionFields($data)
    {
        $array=[];
        foreach($data as $key=>$value)
        {
            $array[]=$key."=:".$key;
        }
        $fields= implode(" and ",$array);
        return $fields;
    }


    //张三，15，丹东
    private function createValues($data)
    {
        $array=[];
        foreach($data as $key=>$value)
        {
            $array[]=$value;
        }
        $fields= implode(",",$array);
        return $fields;
    }
    //pagerData=[PageSize PageIndex ]

    public function queryPage(&$pagerData,$condition=null)
    {
        if(isset($condition))
           $sql=sprintf("select count(id)  from %s where %s",$this->_table,$this->formatConditionFields($condition));
        else
            $sql=sprintf("select count(id) from %s ",$this->_table);
        $totalNum=$this->mypdo->queryOne($sql,$condition);

        $totalNum=$totalNum['count(id)']  ;//总记录数；
        $pageSize=$pagerData['pageSize'];
        $pageIndex=$pagerData['pageIndex'];
        $pageCount=ceil($totalNum/$pageSize);
        //使用sql语句时，注意有些变量应取出赋值。
        $pre = ($pageIndex-1)*$pageSize;
        $tmp=sprintf(" limit %s ,%s",$pre,$pageSize);
        if(isset($condition))
            $sql=sprintf("select *  from %s where %s",$this->_table,$this->formatConditionFields($condition));
        else
            $sql=sprintf("select * from %s ",$this->_table);

        $sql=$sql.$tmp;
        //echo "查询的语句".$sql;
        $result=$this->mypdo->queryALL($sql,$condition);

        $pagerData['pageCount']=$pageCount;
        return $result;
    }
}