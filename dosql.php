<?php

include 'sqlmg.php';
include 'phphtml.php';
$a;
if($_POST)
{
    $cq=$_POST['slcsql'];
    $oq=$_POST['opsql'];

 if($cq=="mysql")
{
  $a=new PHP_MySQL(mysql_connect("localhost:3306","root","root")) ; 

}
else if($cq=="mysqli")
{  
  $a=new PHP_mysqli();
  
}
else if($cq=="pdo")
{
    $a=new PHP_pdo();
}

}

$dbn=$op=$tbn=$top="";

$alldb=$a->showAllDB();
$tr_num=sizeof($alldb);

?>

<html>
    <head>
    <meta charset="UTF-8">
    <title>PHP数据库管理</title>
    <link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<a href="/" >返回首页</a>
<?php



$dball=htmlShowDB($tr_num,$alldb);

print $dball;


?>


</body>
<form>

</form>
</body>
</html>