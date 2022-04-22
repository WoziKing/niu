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
                    页面自动 <a id="href" href="login.php">跳转</a> 等待时间： <b id="wait">3</b>
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

?>
<?php
include_once "../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";
include "../db.php";
// var_dump($_FILES['file']['type']);
date_default_timezone_set("PRC");
if($_FILES['file']['name'] === ""){
    echo "<script type='text/javascript'>;
    alert('请选择值班表');
    location.href = './admin.php';
    </script>";
}
else{

    $sql_1 = "DELETE FROM `table` WHERE 1";
    mysqli_query($conn,$sql_1); 

    $strs="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
    $ramname=substr(str_shuffle($strs),mt_rand(0,strlen($strs)-11),10);


    $allowedExts = array("xls", "xlsx");

    $temp = explode(".", $_FILES["file"]["name"]);
    //var_dump($temp);
    $extension = end($temp);     // 获取文件后缀名
    if (
        (
            ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
            ||
            ($_FILES["file"]["type"] == "application/vnd.ms-excel")
        )
        && ($_FILES["file"]["size"] < 104857600)   // 小于 100 MB
        && in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
            $_FILES["file"]["name"] = $ramname . "." . $extension;
            $fileName = $_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], "excel/" . $_FILES["file"]["name"]);
        }
    }

    $file_path = 'excel/' . $fileName;

    $path = $file_path;



    //读取excel文件————————————————————————————————————————————————————————————————————————————
    try {
        $inputFileType = PHPExcel_IOFactory::identify($path);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($path);
    } catch (Exception $e) {
        die("加载文件发生错误：" . pathinfo($path, PATHINFO_BASENAME) . ":" . $e->getMessage());
    }

    // 读取工作表(0 表示读取第一张工作表)
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow(); // 行数1~5 第一行为表头
    $highestColumn = $sheet->getHighestColumn(); // 列数A~F 第一列为表头

    // echo '获取所有行的数据','<br/>';
    static $list = array();
    for($row = 2;$row <= $highestRow;$row++){
        $list[] = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
    }

echo "<pre>";
var_dump($list);


$timestamp=time();
$_sql="DELETE FROM `total` WHERE (date<'{$timestamp}' and enable=0 and sub_number is NULL)";
//echo $_sql;
$conn->query($_sql);
    //更新数据库————————————————————————————————————————————————————————————————————————————
    for($nb=0;$nb<count($list);$nb++){
            $name = $list[$nb][0][0];
            $number = $list[$nb][0][1];
            $date = strtotime($list[$nb][0][2].'08:00:00');
            $class = $list[$nb][0][3];
		$sql_haved_or_not = "SELECT * FROM `total` WHERE date='{$date}' and class='{$class}' and name='{$name}'";
		$result_haved_or_not = mysqli_query($conn,$sql_haved_or_not);
		$row_haved_or_not=mysqli_fetch_assoc($result_haved_or_not);
        $nb1 = $nb + 1;
        $dc = $date.'-'.$class;
		if($row_haved_or_not!==null){
			echo "<script type='text/javascript'>
                    alert('第" . $nb1 . "条数据已经存在了，姓名为" . $name . "值班时间为" . $dc . "');
                </script>";
                $seccess[$nb]=2;
		}else{	
            		$sql_update = "INSERT INTO `total` 
            		(name,number,date,class,enable) 
            		VALUES 
            		('{$name}','{$number}','{$date}','{$class}',0)";
                    // echo $sql_update;
                    // var_dump($date);
                        if($date === null || $date === '' || $date === false){
                            echo "<script type='text/javascript'>
                                alert('第" . $nb1 . "条数据上传失败，原因是日期为空，请确认Excel中的日期是否为文本形式');
                              </script>";
                            $seccess[$nb]=1;
                        }elseif($name === null || $number === null || $class === null || $name === '' || $number === '' || $class === ''){
                            echo "<script type='text/javascript'>
                                alert('第" . $nb1 . "条数据上传失败');
                              </script>";
                            $seccess[$nb]=1;
                        }else{
                            if($conn->query($sql_update) === true){
                                $seccess[$nb]=0;
                            }else{
                                echo "<script type='text/javascript'>
                                alert('第" . $nb1 . "条数据上传失败');
                              </script>";
                                $seccess[$nb]=1;
                            }
                        }
                        
		}
    }
    
    //————————————————————————————————————————————————————————————————————————————————————
    if( in_array(1,$seccess)===false && in_array(2,$seccess)===false ){
        echo "<script type='text/javascript'>
        alert('恭喜，数据上传成功');
        location.href = './zhiban.php';
        </script>";
    }elseif( in_array(0,$seccess)===false ){
        echo "<script type='text/javascript'>
        alert('绝了，没一个上传成功的');
        location.href = './zhiban.php';
        </script>";
    }else{
        echo "<script type='text/javascript'>
        alert('行吧，部分数据上传成功');
        location.href = './zhiban.php';
        </script>";
    }
}
var_dump($seccess);