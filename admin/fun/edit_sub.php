<?php
//  防止全局变量造成安全隐患
$admin = false;
//  启动会话，这步必不可少
session_start();
//  判断是否登录
if (!isset($_SESSION["admin_fix_3U5AvnlOFCpR6sTg"]) || $_SESSION["admin_fix_3U5AvnlOFCpR6sTg"] !== true)
{
    echo <<<EOL
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
            <title>跳转提示</title>
            <style type="text/css">
                *{ padding: 0; margin: 0; }
                body{ background: #fff; font-family: "Microsoft Yahei","Helvetica Neue",Helvetica,Arial,sans-serif; color: #333; font-size: 16px; }
                .system-message{ padding: 24px 48px; }
                .system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
                .system-message .jump{ padding-top: 10px; }
                .system-message .jump a{ color: #333; }
                .system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px; }
                .system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display: none; }
            </style>
        </head>
        <body>
            <div class="system-message">
                            <h1>:(</h1>
                    <p class="error">用户未登录,无权访问</p>
                            <p class="detail"></p>
                <p class="jump">
                    页面自动 <a id="href" href="../login.php">跳转</a> 等待时间： <b id="wait">3</b>
                </p>
            </div>
            <script type="text/javascript">
                (function(){
                    var wait = document.getElementById('wait'),
                        href = document.getElementById('href').href;
                    var interval = setInterval(function(){
                        var time = --wait.innerHTML;
                        if(time <= 0) {
                            location.href = href;
                            clearInterval(interval);
                        };
                    }, 1000);
                })();
            </script>
        </body>
        </html>
EOL;
exit();
}

?><?php
include "../db.php";


$id=$_POST['id'];
if($_POST['solve_name'] === ""){
    $solve_name = "未解决";
}
else{
    $solve_name=$_POST['solve_name'];
}
$solve_time=$_POST['solve_time'];
$solve=$_POST['solve'];
//默认已解决 直接提交：已解决 更改：NULL
//默认未解决 直接提交：NULL 更改：on
if($_POST['solve_class'] === "已解决" || $_POST['solve_class'] === "on"){
    $solve_class = "已解决";
}
elseif($_POST['solve_class'] === NULL){
    $solve_class = "未解决";
}
$sql_number = "SELECT number FROM `admin` WHERE name = '{$solve_name}'";
$result_number = $conn->query($sql_number);
$row_number=mysqli_fetch_array($result_number,MYSQLI_ASSOC);
$solve_number = $row_number['number'];


var_dump($id);echo "<br>";
var_dump($solve_name);echo "<br>";
var_dump($solve_number);echo "<br>";
var_dump($solve_time);echo "<br>";
var_dump($solve);echo "<br>";
var_dump($_POST['class']);echo "<br>";
var_dump($solve_class);echo "<br>";



$sql = "UPDATE `total` SET solve_name='{$solve_name}', solve_number='{$solve_number}', solve_time='{$solve_time}', solve='{$solve}', solve_class='{$solve_class}' WHERE id='{$id}'";
$conn->query($sql);

echo "<script type='text/javascript'>
alert('更改成功');
location.href = '../index.php';
</script>";

