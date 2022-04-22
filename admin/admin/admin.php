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

include "../db.php";
$username = $_COOKIE["admin_fix_3U5AvnlOFCpR6sTg"];
$admin = json_decode($username,true);
$admin_name = $admin['data']['real_name'];
$admin_number = $admin['number'];

$sql_admin = "SELECT * FROM `admin` WHERE number = '{$admin_number}'";
$result_admin = mysqli_query($conn,$sql_admin);  
$row_admin = mysqli_fetch_assoc($result_admin);

include "../json.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>校园网网络报修后台</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="format-detection" content="telephone=no">
  
  <link rel="stylesheet" href="../../layui/css/layui.css" type="text/css">
<style>
  .layui-table-cell{
    height:40px;
    line-height: 40px;
}
@media only screen and (min-width: 0px) and (max-width: 611px) {
  #file,#submit{
    top:-500px;
  }
  #demo{
    margin-top:-50px;
  }
}
@media only screen and (min-width: 300px) and (max-width: 1200px) {
  .layui-table-header table thead tr th[data-field="do"]{
    width:180px;
  }
  .layui-table-header table thead tr th[data-field="do"] div{
    width:180px;
  }
  td[data-field="do"]{
    width:180px;
  }
  td[data-field="do"] div{
    width:180px;
  }
}
@media only screen and (min-width: 300px) and (max-width: 810px) {
  .layui-table-header table thead tr th[data-field="id"]{
    width:70px;
  }
  .layui-table-header table thead tr th[data-field="id"] div{
    width:70px;
  }
  td[data-field="id"]{
    width:70px;
  }
  td[data-field="id"] div{
    width:70px;
  }
}
@media only screen and (min-width: 300px) and (max-width: 810px) {
  .layui-table-header table thead tr th[data-field="name"]{
    width:80px;
  }
  .layui-table-header table thead tr th[data-field="name"] div{
    width:80px;
  }
  td[data-field="name"]{
    width:80px;
  }
  td[data-field="name"] div{
    width:80px;
  }
}
@media only screen and (min-width: 821px) {
  #hidden{
    display:none;
  }
}
</style>
</head>

<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo" style="font-size: 16px">校园网网络报修后台</div>

    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a>
           <?php echo $admin_name; ?>
        </a>
      </li>
      <li class="layui-nav-item"><a href="javascript:logout();">退出</a></li>
    </ul>

  </div>
  
  <div class="layui-side layui-bg-black"  style="width:130px" id="layuileft">
    <div class="layui-side-scroll"  style="width:130px">
      <ul class="layui-nav layui-nav-tree"  lay-filter="test"  style="width:130px">
        <li class="layui-nav-item layui-nav-itemed">
          <a href="../index.php" style="font-size: 16px;text-align: center;height:60px;line-height:60px">信息管理</a>
        </li>
        <li class="layui-nav-item">
          <a href="../area/index.php" style="font-size: 16px;text-align: center;height:60px;line-height:60px">报修区域</a>
        </li>
        <li class="layui-nav-item">
            <a href="" style="font-size: 16px;text-align: center;height:60px;line-height:60px">管理员设置</a>
        </li>
        <li class="layui-nav-item">
            <a href="./zhiban.php" style="font-size: 16px;text-align: center;height:60px;line-height:60px">值班情况</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="layui-body"  style="left:130px" id="layuibody">
  <button id="hidden" style="position:fixed;z-index:1000;right:20px;bottom:10px;width:40px;height:40px;background-color:#009688;border-radius:5px;font-size:30px;color:#fff;-webkit-user-select:none;user-select:none;border:0px">-</button>
<script>
  var hid=document.getElementById('hidden');
  hid.addEventListener('click',function(){
      var leftwidth = document.getElementById("layuileft").style.width;
      if(leftwidth !== "0px"){
      document.getElementById("layuileft").style.width="0px";
      document.getElementById("layuibody").style.left="0px";
      document.getElementById("layuifooter").style.left="0px";
      document.getElementById("hidden").innerHTML="+";
      }
      else{
        document.getElementById("layuileft").style.width="130px";
        document.getElementById("layuibody").style.left="130px";
        document.getElementById("layuifooter").style.left="130px";
        document.getElementById("hidden").innerHTML="-";
      }
  });
</script>

<a href="add.php"><button class="layui-btn layui-btn-normal layui-btn-mini" style="display:inline-block;margin-top:10px;margin-left:3%;width:110px">添加管理员</button></a>
<a href="excel.php"><button class="layui-btn" style="display:inline-block;margin-top:10px;position: relative;left:12%;width:140px">值班表模板下载</button></a>

<button class="layui-btn" style="display:inline-block;margin-top:10px;position: relative;left:15%;width:110px" id="file">值班表导入</button>
<form class="layui-form" action="read.php" method="POST" enctype="multipart/form-data" style="display:inline-block;position: relative;left:13%;">
<input type="file" name="file" style="display: none" id="fileupload">
<button class="layui-btn" style="display:inline-block;margin-top:10px;position: relative;left:50%;width:70px" id="submit" type="submit">提交</button>
</form>



<table id="demo" style="clear:both" lay-filter="demo"></table>


<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
</script>
  </div>
  
  <div class="layui-footer"  style="left:130px" id="layuifooter">
  <label>沈阳农业大学 大学生网络信息中心 运行部 制作</label>
  </div>

</div>
<script src="../../layui/layui.js" charset="utf-8" type="text/javascript"></script>
         
<script>
layui.use('table', function(){
  var table = layui.table;
          
  table.render({
    elem: '#demo'
    ,data:<?php echo $admindata;?>
    ,height:800
    ,page:true
    ,limit:50
    ,limits:[50,100,150,200]
    ,cols: [[
    {field:'id',  title: 'ID', sort: true,align:'center',width:'5%'}
    ,{field:'name', title: '姓名',align:'center',width:'7%'}
    ,{field:'number', title: '学号', align:'center'}
    ,{field:'uid', title: 'UID', align:'center'}
    ,{field:'do', title: '操作', align:'center',toolbar:"#barDemo"}
    ]]
  });
          
  table.on('tool(demo)', function(obj){
    var data = obj.data;
    var kk=data['id'];
    // alert(kk);
    if(obj.event === 'edit'){
      window.location = "edit.php?id="+kk;
    }
    else if(obj.event === 'del'){
      var r=confirm("你确定要删除吗？");
      if (r==true){
        if (confirm("真的确定删除这条吗？")){
				window.location = "deladmin.php?id="+kk;
			  }
      }
    }
  });

        });
</script>
<script>
        /*<![CDATA[*/
        function logout() {
            layer.confirm('您确定要退出系统吗？',{
                btn:['确定','取消']
            }, function () {
                window.location.href="../fun/out.php";
            });
        }
</script>

<script> 
var file = document.getElementById("file");

file.onclick=function(){

  var a = confirm('上传前请认真与值班表模板比对，确认各单元格的值无误后点击右侧提交');
  if(a === true){
    document.getElementById('fileupload').click();
  }

}

</script> 
<script>
  var btn= document.getElementById("submit"); 
  var submitcount=0;
  btn.onclick =function submitOnce (form){
　　　　if (submitcount == 0){
　　　　submitcount++;
　　　　return true;
　　　　} else{
　　　　　　alert("正在操作，点击“确定”按钮后请稍等几秒。");
　　　　　　return false;
　　　　}
　　}
</script>
</body></html>
