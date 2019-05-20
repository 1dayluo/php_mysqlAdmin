<html>
<head>
    <meta charset="UTF-8">
    <title>PHP数据库管理</title>
    <link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="bgim">
<div id="page">
    <div id="header">
        <h1> PHP数据库管理工具</h1>
 
    </div>

    <div id="page-One">
    <img src="image/sd.jpg" height="100px" width="300px">
    
    <img src="image/233.jpg" height="360px" width="400px">
    </div>

    <div id="page-Two">
        <br />
     
  
<form name="ChoiceSql" method="post" action="dosql.php">
    <h3>请选择连接数据库的方式</h3>
    <input type="radio" name="slcsql" id="radio_1" value="mysql" onclick="show_selected_item_val(this)" />
    MySQL连接 
    <input type="radio" name="slcsql" id="radio_2" value="mysqli" onclick="show_selected_item_val(this)" />
    MySQli连接 
    <input type="radio" name="slcsql" id="radio_3" value="pdo" onclick="show_selected_item_val(this)" />
    PDO连接  
</p>      


<h3>数据库功能</h3>
    1.显示全部数据库 <br />

    2.显示指定数据库下全部表格 <br />
    
    3.显示表格下的全部域 <br />
   
    4.显示表格内的全部值 <br />
   
    5.显示指定表格域下的全部值 <br />
   
    6.创建数据库 <br />
   
    7.创建表格 <br />
  
    8.删除数据库 <br />
   
    9.删除表格 <br />
   
    10.在表格内插入数据 <br />
    <input type="submit" value="确认">

</form>
</p>  


    </div>

</div>

</div>

    </body> 
</html>