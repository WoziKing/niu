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


$fileName='报修平台值班表模板';
$savePath='./';
$isDown=false;
$objPHPExcel = new PHPExcel();

function convertUTF8($str){   
	if(empty($str)) return '';   
	return  iconv('gb2312', 'utf-8', $str);
}

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('sheet');


// var_dump($row);
$objPHPExcel->getActiveSheet()->setCellValue('A1', '序号');
$objPHPExcel->getActiveSheet()->setCellValue('B1', '维护人员');
$objPHPExcel->getActiveSheet()->setCellValue('C1', '学号');
$objPHPExcel->getActiveSheet()->setCellValue('D1', '值班日期');
$objPHPExcel->getActiveSheet()->setCellValue('E1', '第几节课');



$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
$objPHPExcel->getActiveSheet()->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
$objPHPExcel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
$objPHPExcel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
$objPHPExcel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

$objPHPExcel->getActiveSheet()->setCellValue('A2', "1");
$objPHPExcel->getActiveSheet()->setCellValue('B2', "AAA");
$objPHPExcel->getActiveSheet()->setCellValue('C2', "2020202020");
$objPHPExcel->getActiveSheet()->setCellValue('D2', "2021-06-21");
$objPHPExcel->getActiveSheet()->setCellValue('E2', "第一节");

$objPHPExcel->getActiveSheet()->setCellValue('A3', "2");
$objPHPExcel->getActiveSheet()->setCellValue('B3', "BBB");
$objPHPExcel->getActiveSheet()->setCellValue('C3', "2020202021");
$objPHPExcel->getActiveSheet()->setCellValue('D3', "2021-06-21");
$objPHPExcel->getActiveSheet()->setCellValue('E3', "第二节");

$objPHPExcel->getActiveSheet()->setCellValue('A4', "3");
$objPHPExcel->getActiveSheet()->setCellValue('B4', "CCC");
$objPHPExcel->getActiveSheet()->setCellValue('C4', "2020202022");
$objPHPExcel->getActiveSheet()->setCellValue('D4', "2021-06-21");
$objPHPExcel->getActiveSheet()->setCellValue('E4', "第三节");

$objPHPExcel->getActiveSheet()->setCellValue('A5', "4");
$objPHPExcel->getActiveSheet()->setCellValue('B5', "DDD");
$objPHPExcel->getActiveSheet()->setCellValue('C5', "2020202023");
$objPHPExcel->getActiveSheet()->setCellValue('D5', "2021-06-21");
$objPHPExcel->getActiveSheet()->setCellValue('E5', "第三节");

$objPHPExcel->getActiveSheet()->setCellValue('A6', "5");
$objPHPExcel->getActiveSheet()->setCellValue('B6', "DDD");
$objPHPExcel->getActiveSheet()->setCellValue('C6', "2020202023");
$objPHPExcel->getActiveSheet()->setCellValue('D6', "2021-06-21");
$objPHPExcel->getActiveSheet()->setCellValue('E6', "第五节");

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
