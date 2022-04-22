<?php
error_reporting(0);
//设置编码格式
// header("Content-type:application/json;charset=utf-8");   
include 'db.php';
class User {
	public $id;
	public $sub_name;
	public $sub_number;
    public $tel;
    public $area;
    public $time;
    public $detail;
    public $sub_time;
    public $solve_name;
    public $solve_number;
    public $solve_time;
    public $solve;
    public $solve_class;
    public $name;
    public $number;
    public $date;
    public $class;
    public $enable;
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
// 检测连接  
$sql = "SELECT * FROM `total` WHERE solve_class='已解决' or solve_class='未解决'";
$result = mysqli_query($conn,$sql);  
if($result){
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){ 
	    $user = new User();
            $user->id = $row["id"];
            $user->sub_name = $row["sub_name"];
            $user->sub_number = $row["sub_number"];
            $user->tel = $row["tel"];
            $user->area = $row["area"];
            $user->time = $row["time"];
            $user->detail = $row["detail"];
            $user->sub_time = $row["sub_time"];
            $user->solve_name = $row["solve_name"];
            $user->solve_number = $row["solve_number"];
            $user->solve_time = $row["solve_time"];
            $user->solve = $row["solve"];
            $user->solve_class = $row["solve_class"];
            $user->name = $row["name"];
            $user->number = $row["number"];
            $user->date = date("Y-m-d",$row["date"]);
            $user->class = $row["class"];
            $user->enable = $row["enable"];
		$data[]=$user;
	}
	//打印编码后的json字符串
    $json = json_encode($data);
    $tabledata = decodeUnicode($json);
}else{
	echo "查询失败";
}




$sqladmin = "SELECT * FROM `admin` WHERE 1";
$resultadmin = mysqli_query($conn,$sqladmin);  
if($resultadmin){
	while ($arow=mysqli_fetch_array($resultadmin,MYSQLI_ASSOC)){ 
        $adata[]=[
            'id' => $arow["id"],
            'name' => $arow["name"],
            'number' => $arow["number"],
            'uid' => $arow["uid"]
        ];
    }
    $ajson = json_encode($adata);
    $admindata = decodeUnicode($ajson);
}else{
	echo "查询失败";
}



$sqladmin_zhiban = "SELECT * FROM `total` WHERE enable=0";
$resultadmin_zhiban = mysqli_query($conn,$sqladmin_zhiban);  
if($resultadmin_zhiban){
	while ($arow_zhiban=mysqli_fetch_array($resultadmin_zhiban,MYSQLI_ASSOC)){ 
        $adata_zhiban[]=[
            'id' => $arow_zhiban["id"],
            'name' => $arow_zhiban["name"],
            'number' => $arow_zhiban["number"],
            'date' => date("Y-m-d",$arow_zhiban["date"]),
            'class' => $arow_zhiban["class"]
        ];
    }
    $ajson_zhiban = json_encode($adata_zhiban);
    $admindata_zhiban = decodeUnicode($ajson_zhiban);
}else{
	echo "查询失败";
}
?>