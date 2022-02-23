<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."includes/user.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]."includes/upload.class.php");
if($_POST["f"]=="Check"){
	$username=$_POST["username"];
	$phone=$_POST["phone"];
	$email=$_POST["email"];
	$identity=$_POST["identity"];
	$user=new User();
	$user->updateObj(username: $username,phone: $phone,email: $email,identity: $identity);
	$user->Check();
}

if($_POST["f"]=="Reg"){
	$username=$_POST["username"];
	$name=$_POST["name"];
	$phone=$_POST["phone"];
	$email=$_POST["email"];
	$qq=$_POST["qq"];
	$password=$_POST["password"];
	$ip=$_SESSION["ip"];
	$timestamp=time();
	$url="https://ssl.captcha.qq.com/ticket/verify?Ticket=".$_POST["Ticket"]."&UserIP=".$ip."&Randstr=".$_POST["Randstr"]."&aid=".TC_APPID."&AppSecretKey=".TC_KEY;
	$capData=file_get_contents($url);
	$capData=json_decode($capData);
	if($capData->response=="1"){
		$user=new User();
		$user->updateObj(username: $username,phone: $phone,email: $email,name: $name,qq: $qq);
		$result=$user->Register(password: $password,ip: $ip);
		echo($result);
	}else{
		echo("孙笑川");
	}
}

if($_POST["f"]=="Login"){
	$login=$_POST["login"];
	$password=$_POST["password"];
	$ip=$_SESSION["ip"];
	$user=new User();
	echo($user->Login($login,$password,$ip));
}
?>