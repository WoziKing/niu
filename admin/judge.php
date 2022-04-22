<?php
//header("Content-Type: text/html;charset=utf-8");
include "db.php";


$post=$_POST;
$rUser=$post['username'];
$rPwd=$post['passpord'];
//echo $rUser;

$result = mysqli_query($conn,"SELECT * FROM `admin` WHERE username = '{$rUser}'");
$row = mysqli_fetch_array($result);

$status=0;
$message='密码错误';	

if ($rUser !== null && $rPwd !== null && $row['username'] === $rUser && $row['pwd'] === $rPwd) {
	$status=1;
	$message='登录成功，点击确认进入后台';
	// echo json_encode('json');
	// return '12';
	session_set_cookie_params(24*3600);
    setcookie("admin", $rUser, time()+3600*24);
	session_start();
	$_SESSION['admin']=true;
}
$data=['status'=>$status,'message'=>$message];
echo json_encode($data);
exit();

?>
