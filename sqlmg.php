<?php
class PHP_MySQL
{
    public static $conn;
   //构造函数
    public function __construct($myconn)
    {
       // $conn;
       
       $this->conn = $myconn;
        //mysql_connect('localhost:3306','root','root');
        
    }
    //析构函数
    public function __destruct()
    {
        mysql_close($this->conn);
    }

    //显示全部数据库
    public function  showAllDB()
    {
      
        //$this->$conn=$conn;
        $db_list=mysql_list_dbs($this->conn);
        $db_rows=mysql_num_rows($db_list);
        $i=0;
        
        while($i<$db_rows)
        {
            $alldb[$i]=mysql_db_name($db_list,$i);
           
            $i++;
        }
        return $alldb;
    }
    //显示指定数据库下的全部表格名称
    function showAllTable($dbname)
    {
        //$this->$conn=$conn;
        mysql_select_db($dbname,$this->conn) or die(mysql_error());
        $table_list=mysql_list_tables($dbname);
        $alltb=array();
        for($i=0;$i<mysql_num_rows($table_list);$i++)
        {
            printf("Table:%s\n",mysql_tablename($table_list,$i));
            $alltb[$i]=mysql_tablename($table_list,$i);
        }
    
        return $alltb;

    }
    //显示表格下的表头
    function showAllField($dbname,$tablename)
    {

        
        $allfield=mysql_list_fields($dbname,$tablename,$this->conn);
        $cl=mysql_num_fields($allfield);
        $i=0;
        $fieldname=array();
        
        while($i<$cl)
        {   
           
            //array赋值
            $fieldname[$i]=mysql_field_name($allfield,$i);
            $i++;
            
        }
     
        

        return $fieldname;
    }
    //提取表格全部值
    function showAllValues($dbname,$tablename)
    {
        $selectall=mysql_query("select * from $dbname.$tablename");
       $allfields=$this->ShowFieldsAll($dbname,$tablename,$this->conn);
       $row=sizeof($allfields);
       $resar=array();$i=0;
        while($result=mysql_fetch_array($selectall))
        {
            
            foreach($result as $m)
            {
                //$resar[$i++]=current($res);
                $resar[$i++]=$m;
              
            }
        
      }

            return $resar;       
    }
    //提取表格内的指定field下全部值
    function ShowFieldsValues($dbname,$tablename,$fieldname)
    {

        mysql_select_db($dbname,$this->conn) or die('use db error >A<!');
        $my_query=mysql_query("select $fieldname from $tablename");
            
          //  $allfields=$this->ShowFieldsAll($dbname,$tablename,$conn);
          //https://www.docs4dev.com/docs/zh/mysql/5.7/reference/mysql-fetch-fields.html
         $results=array();
         $i=0;
         while($value=mysql_fetch_array($my_query))
         {
            
             $results[$i++]=$value[0];
         }
         return $results; 
    
    }
    //创建数据库
    function CreateDB($dbname)
    {
       
        if(mysql_query("create database $dbname"))
        {
            return true;
        }    
        else
        {
            return false;
        }
        
    }
    //创建表
    function CreateTable($tbname,$dbname,$tbar1,$tbar2)
    {
        //tbar1提供表字段名
        //tbar2提供表字段类型
        mysql_select_db($dbname,$this->conn) or die(mysql_error());
        if(sizeof($tbar2)!=sizeof(($tbar2))) 
        {
            //字段不对应
            
            return false;
        }
        $querystring="";$i=0;
        for($i;$i<(sizeof($tbar2)-1);$i++)
        {
            $querystring=$querystring."`".$tbar1[$i]."` ".$tbar2[$i].",";
            //$querystring=$querystring." ".$tbar1[$i]." ".$tbar2[$i].",";
        }
        $querystring=$querystring."`".$tbar1[$i]."` ".$tbar2[$i];
        //$querystring=$querystring." ".$tbar1[$i].$tbar2[$i];
        $querystring="create table ".$tbname."(".$querystring.")";
        echo $querystring."<br />";       
         $result=mysql_query("$querystring") or die(mysql_error());
         if($result)
         {
             echo "ok";
             return true;
         }
         else
         {
             echo "no";
             return false;
         }
    

    }
    //删除数据库
    function DropDataBase($dbname)
    {
        if(mysql_query("drop database $dbname"))
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    //删除表格
    function DropTable($dbname,$tbname)
    {
        if(mysql_query("drop table $dbname.$tbname"))
        {
            echo "OK";
            return true;
        }
        else
        {
            echo "NOOO";
            return false;
        }
    }
    //插入数据
    function InsertValue($dbname,$tbname,$values)
    {
        $count=sizeof($values);
        $querystring="";
        for($i=0;$i<$count-1;$i++)
        {
            $querystring=$querystring."\"".$values[$i]."\",";
        }
        $querystring="insert into $dbname".".$tbname values(".$querystring."\"".$values[$i]."\")";
        echo $querystring;
        $result=mysql_query($querystring) or die(mysql_error());
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
class PHP_mysqli
{
    //构造函数
    static $conni;
    

    function __construct()
    {
        $arg_num=func_num_args();
     
        if($arg_num==0)
        {
            $this->conni=@new mysqli("localhost:3306","root","root");
        }
        else if($arg_num==1)
        {
            
            $this->conni=func_get_arg (0);  
        }
    }
    //析构函数
    function __destruct()
    {
        $this->conni->close();
    }
    //显示全部数据库
    function showAllDB()
    {
        $querystring="show databases";
        $qrs=$this->conni->query($querystring);
        $i=0;
        while($res=$qrs->fetch_array())
        {
            
            $alldb[$i++]=$res[0];
            
           
        }
        return $alldb;
    }
    //显示指定数据库下全部表格
    function showAllTable($dbname)
    {
            $this->conni->select_db($dbname);
            $querystring="show tables";
            $qrs=$this->conni->query($querystring);
            while($res=$qrs->fetch_array())
            {
                echo $res[0];
                
                echo "<br />";
            }

    }
    //显示表格内全部值
    function showAllValues($dbname,$tbname)
    {
        $this->conni->select_db($dbname);
        $querystring="select * from $dbname.$tbname";
        $qrs=$this->conni->query($querystring);
        $i=0;
        while($res=$qrs->fetch_array())
        {
        
            foreach($res as $m)
            {
                //$resar[$i++]=current($res);
                $res_ar[$i++]=$m;
              
            }

        }
        return $res_ar;
    }
    //显示指定表头下的全部值
    function showFieldsValues($dbname,$tbname,$fdname)
    {
        $this->conni->select_db($dbname);
        $querystring="select $fdname from $tbname";
        $qrs=$this->conni->query($querystring);
        $res_ar=array();
        $i=0;
        while($res=$qrs->fetch_array())
        {
           // echo $res[0];
          //  echo "<br />";
            $res_ar[$i++]=$res[0];


        }

        return $res_ar;

    }
    //创建数据库
    function CreateDb($dbname)
    {
        $querystring="create database $dbname";
        echo $querystring;
        $qrs=$this->conni->query($querystring);
        if($qrs)
        {
            return true;
        }
        else
        {
            return $this->conni->error;
        }
    }
    //创建表
    function CreateTable($dbname,$tbname,$ar1,$ar2)
    {
        $this->conni->select_db($dbname);
        if(sizeof($ar1)!=sizeof($ar2))
            return false;
        for($i=0;$i<sizeof($ar1)-1;$i++)
        {
            $querystring="`$ar1[$i]`$ar2[$i]".",";
        }
        $querystring="create table $tbname "."("."$querystring`$ar1[$i]`$ar2[$i]".")";
        if($this->conni->query($querystring))
        {
            return true;
        }
        else
        {
            echo "No".$this->conni->error;
            return false;
        }

        
    }
    //删除数据库
    function DropDataBase($dbname)
    {
        $querystring="drop database $dbname";
        if($this->conni->query($querystring))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    //删除表
    function DropTable($dbname,$tbname)
    {
        $this->conni->select_db($dbname);
        $querystring="drop table $tbname";
        if($this->conni->query($querystring))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    //表格中插入数据
    function InsertValue($dbname,$tbname,$arvalue)
    {
        $this->conni->select_db($dbname);
        
        for($i=0;$i<sizeof($arvalue)-1;$i++)  
        {
            $querystring="\"$arvalue[$i]\",";
         }
    $querystring="insert into $tbname values (".$querystring."\"$arvalue[$i]\"".")";
    echo $querystring;
    if($this->conni->query($querystring))
    {
        
        return true;
    }
    else
    {
        echo $this->conni->error;
        return false;
    }

}
}
class PHP_pdo 
{
    public $pconn;
    //构造函数
    function __construct()
    {
        
        $arg_num=func_num_args();
        if($arg_num==0)
        {
            $dsn = 'mysql:dbname=test;host=127.0.0.1';
            $user = 'root';
            $password = 'root';
            $this->pconn=@new PDO($dsn, $user, $password);
         
        }
        else if($arg_num==1)
        {
            $this->pconn=func_get_arg(0);
           
        }
        
    }
    //析构函数
    function __destruct()
    {
        //关闭连接
        $this->pconn=null;

    }
    //显示全部数据库
    function showAllDB()
    {
        $querystring="show databases";
        $sth=$this->pconn->prepare($querystring);
        $resar=array();$i=0;
        if($sth->execute())
        {
            while($res=$sth->fetch(PDO::FETCH_ASSOC))
            {
                $resar[$i++]=$res["Database"];
                
            }
            return $resar;
        }
        else
        {
            return false;
        }
        

    }
    //显式指定数据库下全部表格
    function showAllTable($dbname)
    {
        $querystring="show tables";
        $this->pconn->query("use $dbname");
        $sth=$this->pconn->prepare("$querystring");
        $resar=array();$i=0;
        if($sth->execute())
        {
            while($res=$sth->fetch(PDO::FETCH_ASSOC))
            {
                $resar[$i++]=current($res);
               
            }
            return $resar;
        }
        else
        {
            return false;
        }
        

    }
    //显示表格下的表头
    function ShowAllField($dbname,$tbname)
    {
        $this->pconn->query("use $dbname");
        $querystring="select COLUMN_NAME from information_schema.COLUMNS where table_name='$tbname'";
        $sth=$this->pconn->prepare($querystring);
        $resar=array();$i=0;
        if($sth->execute())
        {
            while($res=$sth->fetch(PDO::FETCH_ASSOC))
            {
                $resar[$i++]=current($res);
            }
            return $resar;
        }
        else
            return false;
        
    }
    //显示表格内的全部值
    function showAllValues($dbname,$tbname)
    {
        $this->pconn->query("use $dbname");
        $querystring="select * from $tbname";
        $sth=$this->pconn->prepare($querystring);
        $resar=array();$i=0;
        if($sth->execute())
        {
            while($res=$sth->fetch(PDO::FETCH_NUM))
            {
                
                foreach($res as $m)
                {
                    //$resar[$i++]=current($res);
                    $resar[$i++]=$m;
                  
                }
               
                
                
            }
            return $resar;
            
        }
        else
        {
           
            return false;
        }
    }
    //显示指定表头下的全部值
    function showFieldsValues($dbname,$tbname,$fdname)
    {
        try{
            $this->pconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $this->pconn->query("use $dbname");
        $querystring="select $fdname from $tbname";
        $sth=$this->pconn->prepare($querystring);
        $resar=array();$i=0;
        if($sth->execute())
        {
            while($res=$sth->fetch(PDO::FETCH_ASSOC))
            {
               $resar[$i++]=current($res);
                
            }
            return $resar;

        }
        else 
        {
            
            return false;
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

    

    }
    //创建数据库
    function CreateDB($dbname)
    {
        $querystring="create database $dbname";
        $sth=$this->pconn->prepare($querystring);
        if($sth->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    //创建表
    function CreateTable($dbname,$tbname,$ar1,$ar2)
    {

        if(sizeof($ar1)!=sizeof($ar2))
        {
            return false;
        }
        $this->pconn->query("use $dbname");
        $i=0;$querystring="";
        for($i;$i<sizeof($ar1)-1;$i++)
        {
           
            $querystring=$querystring."`$ar1[$i]`".$ar2[$i].",";
            
        }
        
        $querystring="create table $tbname(".$querystring."`$ar1[$i]`".$ar2[$i].",unique key k($ar1[0]))";
        $sth=$this->pconn->prepare($querystring);
        if($sth->execute())
        {
            
            return true;
        }
        else
        {
           
            return false;
        }
    }
    //删除数据库
    function DropDataBase($dbname)
    {
        $querystring="drop database $dbname";
        $sth=$this->pconn->prepare($querystring);
        if($sth->execute())
        {
            echo "ok";
            return true;
        }
        else
        {
            echo "no";
            return false;
        }
    }
    //删除表
    function DropTable($dbname,$tbname)
    {
        $this->pconn->query("use $dbname");
        $querystring="drop table $tbname";
        $sth=$this->pconn->prepare($querystring);
        if($sth->execute())
        {
            echo "ok";
        }
        else
        {
            echo "no";
        }
    }
    //表格中插入数据
    function InsertValue($dbname,$tbname,$vlar)
    {
        $this->pconn->query("use $dbname");
        $i=0;$querystring="";
        for($i;$i<sizeof($vlar)-1;$i++)
        {
            $querystring=$querystring."\"$vlar[$i]\"".",";
        }
        $querystring="insert into $tbname values(".$querystring."\"$vlar[$i]\")";
        $sth=$this->pconn->query($querystring);
        if($sth->execute())
        {
            echo "ok";
            return true;
        }
        else
        {
            echo "no";
            return false;

        }

    }
}


#pdo连接数据库方式测试代码
$a=new PHP_pdo();
//$a->showAllTable("test");
//$a->ShowFieldsValues("test","t2","age");
//$a->CreateDB("hhh233"); 
$ar1=array("school","grade","name");
$ar2=array("char(20)","int(20)","char(30)");
//$a->CreateTable("test","t3_school",$ar1,$ar2);
//$a->DropDataBase("jintianyizhizaidayi");
//$a->DropTable("test","hhasuu");
//$a->InsertValue("test","t2",array("neo","16"));
//$sth=$this->pconn->prepare($querystring);
    $dsn = 'mysql:dbname=test;host=127.0.0.1';
    $user = 'root';
    $password = 'root';
  $dbh=new PDO($dsn,$user,$password);

#MYSQLI连接数据库方式测试代码
//$a=new Php_mysqli();
#MYSQL连接数据库方式测试代码
 //   $a=new PHP_MySQL($new_conn);
 


?>