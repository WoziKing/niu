<?php 
//  防止全局变量造成安全隐患
$admin = false;
//  启动会话，这步必不可少
session_start();

//  判断是否登录
if (isset($_SESSION["admin_fix_3U5AvnlOFCpR6sTg"]) && $_SESSION["admin_fix_3U5AvnlOFCpR6sTg"] === true) {
    // $_SESSION["admin"] = false;
    // session_destroy();
    // die("您无权访问");	
    // include 'file';
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
                    <p class="error">您已登录，请勿重复登录</p>
                            <p class="detail"></p>
                <p class="jump">
                    页面自动 <a id="href" href="index.php">跳转</a> 等待时间： <b id="wait">3</b>
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
<!DOCTYPE html>
<!-- saved from url=(0029)http://210.47.163.147/denglu/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <title>奶牛疾病远程智能诊疗平台</title>
  <meta name="description" content="particles.js is a lightweight JavaScript library for creating particles.">
  <meta name="author" content="Vincent Garreau">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" media="screen" href="./css/style.css">
  <link rel="stylesheet" type="text/css" href="./css/reset.css">
</head>
<body>

<div id="particles-js">
		<div class="login">
			<div class="login-top">
            奶牛疾病远程智能诊疗平台
			</div>
			<form action="syauLdap.php" method="POST">
			<div class="login-center clearfix">
				<div class="login-center-img"><img src="../public/img/name.png"></div>
				<div class="login-center-input">
					<input type="text" name="name" value="" placeholder="请输入您的用户名" onfocus="this.placeholder=&#39;&#39;" onblur="this.placeholder=&#39;请输入您的用户名&#39;">
					<div class="login-center-input-text">用户名</div>
				</div>
			</div>
			<div class="login-center clearfix">
				<div class="login-center-img"><img src="../public/img/password.png"></div>
				<div class="login-center-input">
					<input type="password" name="pwd" value="" placeholder="请输入您的密码" onfocus="this.placeholder=&#39;&#39;" onblur="this.placeholder=&#39;请输入您的密码&#39;">
					<div class="login-center-input-text">密码</div>
				</div>
			</div>
			<div style="text-align:center;">
				<input type="submit" style="width:250px;height:40px;border:none;background-color:dodgerblue;margin:0 auto;color:white;" value="登录" id="login">
			</div>
			</form>
		</div>
		<div class="sk-rotating-plane"></div>
</div>

<script type="text/javascript" src="../lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="../static/h-ui/js/H-ui.js"></script>
<script>
	$(function(){
	    $('#login').on('click', function(){
	        $.ajax({
				type: 'POST',
				url: "./judge.php",
				data: $('form').serialize(),/*md5(md5($('#user').val() + $('#pwd').val()).$('#pwd').val())*/
				dataType: 'json',
				success: function(data){
					if (data.status == 1) {
					    alert(data.message);
					    window.location.href="./index.php";
					} else {
					    alert(data.message);
					}
				}
			});
		})
	})
</script>
</body>
</html>