<?php
// 数据库数据&&数据库连接
$dbms='mysql';           //数据库类型
$servername='localhost'; //数据库主机名
$port='3306';	         //端口
$dbname='fix';       //使用的数据库
$username='fix';        //数据库连接用户名
$password='syau8848';      //对应的密码

$conn = mysqli_connect($servername, $username, $password, $dbname ,$port);
mysqli_set_charset($conn, "utf8");

if($conn->connect_error)
{
    die('Could not connect :' . $conn->connect_error);
}


