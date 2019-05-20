

<?php
include "dosql.php";



$tbn=$_POST['tbn'];
$fn=$_POST['fn'];
$fvalue=$_POST['values'];
$arr1=array();

$tpfn=$fn;

$i=0;
$c1=strpos($tpfn,',');
$num=(int)$c1;
while($num!=0)
{
   
    $arr1[$i++]=substr($tpfn,0,$num);
    $tpfn=substr($tpfn,$num+1);
    $c1=strpos($tpfn,',');
    $num=(int)$c1;
 
    
}
$arr1[$i]=$tpfn;
 


$tfvalue=$fvalue;
$i=0;
$c2=strpos($tfvalue,',');
$num=(int)$c2;
while($num!=0)
{
   
    $arr2[$i++]=substr($tfvalue,0,$num);
    $tfvalue=substr($tfvalue,$num+1);
    $c2=strpos($tfvalue,',');
    $num=(int)$c2;
 
    
}
$arr2[$i]=$tfvalue;
$result=$a->CreateTable($dbn,$tbn,$arr1,$arr2);
    
header('Location:');

//echo "第 0 次循环，c1=$num <br /> 剩余字符串 tpfn 为:  ".$tpfn."<br />";
//echo "当前数组的值为:".$arr1[0]."<br />";







?>