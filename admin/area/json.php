<?php
error_reporting(0);
//设置编码格式
// header("Content-type:application/json;charset=utf-8");   
include '../db.php';
class User {
	public $id;
	public $name;
    public $class;
}
//汉字转码
function decodeUnicode($str){
  return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
    create_function(
      '$matches',
      'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
    ),
    $str);
}
$data = array();




$sql_ss = "SELECT * FROM `area` WHERE class='1'";
$result_ss = mysqli_query($conn,$sql_ss);  
if($result_ss){
	while ($row_ss=mysqli_fetch_array($result_ss,MYSQLI_ASSOC)){ 
	    $user = new User();
		$user->id = $row_ss["id"];
		$user->name = $row_ss["name"];
        $user->class = $row_ss["class"];
		$data_ss[]=$user;
	}
	//打印编码后的json字符串
    $json_ss = json_encode($data_ss);
    $tabledata_ss = decodeUnicode($json_ss);
	// echo $tabledata;
}else{
	echo "查询失败";
}


$sql_jxkybm = "SELECT * FROM `area` WHERE class='2'";
$result_jxkybm = mysqli_query($conn,$sql_jxkybm);  
if($result_jxkybm){
	while ($row_jxkybm=mysqli_fetch_array($result_jxkybm,MYSQLI_ASSOC)){ 
	    $user = new User();
		$user->id = $row_jxkybm["id"];
		$user->name = $row_jxkybm["name"];
        $user->class = $row_jxkybm["class"];
		$data_jxkybm[]=$user;
	}
	//打印编码后的json字符串
    $json_jxkybm = json_encode($data_jxkybm);
    $tabledata_jxkybm = decodeUnicode($json_jxkybm);
	// echo $tabledata;
}else{
	echo "查询失败";
}

$sql_fwglbm = "SELECT * FROM `area` WHERE class='3'";
$result_fwglbm = mysqli_query($conn,$sql_fwglbm);  
if($result_fwglbm){
	while ($row_fwglbm=mysqli_fetch_array($result_fwglbm,MYSQLI_ASSOC)){ 
	    $user = new User();
		$user->id = $row_fwglbm["id"];
		$user->name = $row_fwglbm["name"];
        $user->class = $row_fwglbm["class"];
		$data_fwglbm[]=$user;
	}
	//打印编码后的json字符串
    $json_fwglbm = json_encode($data_fwglbm);
    $tabledata_fwglbm = decodeUnicode($json_fwglbm);
	// echo $tabledata;
}else{
	echo "查询失败";
}
?>