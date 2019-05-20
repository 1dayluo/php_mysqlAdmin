<?php
function htmlShowDB($tr_num,$alldb)
{
    $tab_str="<table border=\"1\" width=\"80%\" align=\"center\">\n ";

    $dbopar=array("显示全部表格","删除数据库","添加表格");
    for($i=0;$i<$tr_num;$i++)
    {
        $tab_str .="<tr>\n";
        $tab_str.="<td> $alldb[$i] </td>";   
        for($k=0;$k<sizeof($dbopar);$k++)
        {
            $tab_str.="<td>\n<a href=\"tbop.php?dbname=$alldb[$i]&op=$k\">\n".$dbopar[$k]."</a></td>";
        }
        $tab_str .="</tr>\n";
    }
    $tab_str.="</table>\n";
    return $tab_str;
}
function htmlShowTable($dbn,$a)
{
    $opar=array("删除表","显示表内全部值","插入值");
    $resar=$a->showAllTable("$dbn");
    $row=sizeof($resar);
    $tab_str="<table border=\"1\" width=\"80%\" align=\"center\">\n ";
    for($i=0;$i<$row;$i++)
    {
        $tab_str .="<tr>\n";
        $tab_str .="<td>\n".$resar[$i]."</td>";
        for($k=0;$k<sizeof($opar);$k++)
        {
            
            $tab_str .= "<td><a href=\"tbop.php?tbname=$resar[$i]&top=$k&dbname=$dbn\">\n".$opar[$k]."</td>";
   
        }
        $tab_str .="</tr>\n";
    }
    $tab_str .= "</table>\n";
    return $tab_str;
}

function htmlShowValue($a,$dbn,$tbn)
{
    
    $fields=$a->showAllField($dbn,$tbn);
    $value=$a->showAllValues($dbn,$tbn);
    //Mark
  
    //$row=sizeof($value);
    $cow=sizeof($fields);
    $row=sizeof($value);
    $index=0;
    $arr=Matrixtranspose($value,$row,$cow);

    $tab_str="<table border=\"1\" width=\"80%\" align=\"center\">\n ";
    $tab_str .="<tr>\n";
    for($i=0;$i<sizeof($fields);$i++)
    {
        $tab_str .=" <td>".$fields[$i]."</td>";
    }
    $tab_str .="</tr>";
    $krow=$row/$cow;
    for($k=0;$k<$krow;$k++)
    {
        
        $tab_str .="<tr>\n";
        for($l=0;$l<$cow;$l++)
        {
           
            
          //  $tab_str .="<td>".$value["$k"]."</td>";
             $tab_str .="<td>".$arr[$index][0]."</td>";
             $index++;
            
        }
        $tab_str .="</tr>\n";
        
    }
    $tab_str .="</tr>";
    $tab_str .= "</table>\n";
    return $tab_str;
}
//行列互换函数，用于按照数列为表头的方式输出表格内全部值
function Matrixtranspose($array,$row,$cow)
{
   
    for($i=0;$i<$row;$i++)
    {
        for($j=0;$j<$cow;$j++)
        {
            $yarra[$i][$j]=$array[$i];
        }
    }
    return $yarra;
}
function htmlInsertValue($dbn,$tbn,$arr)
{
  

}

?>