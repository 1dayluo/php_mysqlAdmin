<html>
<head>
    <meta charset="UTF-8">
    <title>PHP数据库管理</title>
    <link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>
 
<?php
//include 'dosql.php';
include 'createtb.php';
//op为1是显示全部表格；为2是删除数据库


$dbn=htmlspecialchars($_GET['dbname']);
$op=htmlspecialchars($_GET['op']);
$tbn=htmlspecialchars($_GET['tbname']);
$top=htmlspecialchars($_GET['top']);



//dosql.php的内容包括了输出DB表格所以这页也会出现同样的表格???





if($op=="0")
{

    $tab_str=htmlShowTable($dbn,$a);
    print $tab_str;
}
else if($op=="1")
{
    
    $a->DropDataBase($dbn);

    header('Location: '.$_SERVER["HTTP_REFERER"]);
    
    
}
else if($op=="2")
{
    //到另一页面 添加完成后自动返回
    header('Location: createtb.html');
   
   
}

if($top=="0")
{

    
   $a->DropTable($dbn,$tbn);
   header('Location: '.$_SERVER["HTTP_REFERER"]);
   
   
    
}
if($top=="1")
{
    $tab_str=htmlShowValue($a,$dbn,$tbn);
    echo $tab_str;
}

if($top=="2")
{
    
    $top=1;
    ?><form id="insertVl" action="insertVl.php?tbn=<?php echo $tbn ?>&dbn=<?php echo $dbn?>" align="center" method="POST" >
    <p>插入的值（逗号隔开）:     <input type="text" name="vn" /></p>
    <input href="tbop.php" type="submit" name="button" value="提交" /> 
    </form>

    <?php
     if (isset($_POST['submit'])) {
        header('location:tbop.php');//处理数据后，转向到其他页面
     }



}
?>

</body>
</html>