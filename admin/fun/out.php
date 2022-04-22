<?php
session_start();
setcookie("admin_fix_3U5AvnlOFCpR6sTg", "", time()-3600*24);
unset($_SESSION["admin_fix_3U5AvnlOFCpR6sTg"]);
$_SESSION["admin_fix_3U5AvnlOFCpR6sTg"]=false;
header("location:../index.php");