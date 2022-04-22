<?php
error_reporting(0);

//设置编码格式
// header("Content-type:application/json;charset=utf-8");   
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
 

$kw = $_POST['keyword'];
if($kw === "" || $kw === null){
  echo "<script type='text/javascript'>
  alert('请输入要搜索的关键词');
  location.href = '../index.php';
  </script>";
}
$sql = "SELECT * FROM `total` WHERE
sub_name LIKE '%$kw%' or
sub_number LIKE '%$kw%' or
tel LIKE '%$kw%' or
area LIKE '%$kw%' or
time LIKE '%$kw%' or
sub_time LIKE '%$kw%' or
solve_name LIKE '%$kw%' or
solve_time LIKE '%$kw%'";
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
        $user->date = $row["date"];
        $user->class = $row["class"];
        $user->enable = $row["enable"];
		$data[]=$user;
	}
	//打印编码后的json字符串
    $json = json_encode($data);
    // $tabledata = "{&quot;code&quot;:0,&quot;msg&quot;:&quot;&quot;,&quot;count&quot;:1000,&quot;data&quot;:&quot;" . decodeUnicode($json) . "}";
    $tabledata = decodeUnicode($json);
	// echo $tabledata;
}else{
	echo "<script type='text/javascript'>
                    alert('查询失败');
                    </script>";
}

mysqli_close($conn);
?>