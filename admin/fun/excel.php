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
include '../PHPExcel-1.8/Classes/PHPExcel.php';
include '../PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';

include "../db.php";

$fileName='Data_from_fix.syau.edu.cn';
$savePath='./';
$isDown=false;
$objPHPExcel = new PHPExcel();

function convertUTF8($str){   
	if(empty($str)) return '';   
	return  iconv('gb2312', 'utf-8', $str);
}

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('sheet');

$sql = "SELECT * FROM `total`";
$result = mysqli_query($conn,$sql);  
// $row = mysqli_fetch_assoc($result);

// var_dump($row);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
$objPHPExcel->getActiveSheet()->setCellValue('B1', '报修人姓名');
$objPHPExcel->getActiveSheet()->setCellValue('C1', '报修人学号');
$objPHPExcel->getActiveSheet()->setCellValue('D1', '联系方式');
$objPHPExcel->getActiveSheet()->setCellValue('E1', '报修地点');
$objPHPExcel->getActiveSheet()->setCellValue('F1', '预约时间');
$objPHPExcel->getActiveSheet()->setCellValue('G1', '故障描述');
$objPHPExcel->getActiveSheet()->setCellValue('H1', '报修时间');
$objPHPExcel->getActiveSheet()->setCellValue('I1', '维修人');
$objPHPExcel->getActiveSheet()->setCellValue('J1', '维修时间');
$objPHPExcel->getActiveSheet()->setCellValue('K1', '解决方式');
$objPHPExcel->getActiveSheet()->setCellValue('L1', '状态');


$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


$i = 2;
while($row=mysqli_fetch_assoc($result)){
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $row['id']);
	$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $row['sub_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $row['sub_number']);
	$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $row['tel']);
	$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $row['area']);
	$objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $row['time']);
	$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $row['detail']);
	$objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $row['sub_time']);
	$objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $row['solve_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $row['solve_time']);
	$objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $row['solve']);
	$objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $row['solve_class']);
	$i++;
}

if(!$fileName){ 

	$fileName = uniqid(time(),true); 

} 

$objWrite = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 

header('pragma:public'); 

header("Content-Disposition:attachment;filename=$fileName.xls"); 

$objWrite->save('php://output');

$_fileName = iconv("utf-8", "gb2312", $fileName);   //转码 

$_savePath = $savePath.$_fileName.'.xls'; 

$objWrite->save($_savePath); 

return $savePath.$fileName.'.xls'; 
?>
