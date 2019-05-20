

<?php
include "tbop.php";

$dbn=$_GET['dbn'];
$tbn=$_GET['tbn'];
$vn=$_POST['vn'];

$varr1=array();

$tpfn=$vn;

$i=0;
$c1=strpos($tpfn,',');
$num=(int)$c1;
while($num!=0)
{
   
    $varr1[$i++]=substr($tpfn,0,$num);
    $tpfn=substr($tpfn,$num+1);
    $c1=strpos($tpfn,',');
    $num=(int)$c1;
 
    
}
$varr1[$i]=$tpfn;




$result=$a->InsertValue($dbn,$tbn,$varr1);

   //处理数据后，转向到其他页面




//echo "第 0 次循环，c1=$num <br /> 剩余字符串 tpfn 为:  ".$tpfn."<br />";
//echo "当前数组的值为:".$arr1[0]."<br />";







?>