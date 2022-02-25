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
	$username=htmlspecialchars($_POST["username"]);
	$name=htmlspecialchars($_POST["name"]);
	$phone=intval(htmlspecialchars($_POST["phone"]));
	$email=htmlspecialchars($_POST["email"]);
	$qq=intval(htmlspecialchars($_POST["qq"]));
	$password=$_POST["password"];
	$ip=$_SESSION["ip"];
	$timestamp=time();
	$url="https://ssl.captcha.qq.com/ticket/verify?Ticket=".$_POST["Ticket"]."&UserIP=".$ip."&Randstr=".$_POST["Randstr"]."&aid=".TC_APPID."&AppSecretKey=".TC_KEY;
	$capData=file_get_contents($url);
	$capData=json_decode($capData);
	if($capData->response=="1"){
		$user=new User();
		$user->updateObj(username: $username,phone: $phone,email: $email,name: $name,qq: $qq);
		echo($user->Register(password: $password,ip: $ip));
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

if($_POST["f"]=="UpdatePass"){
	$uid=$_SESSION["uid"];
	$op=$_POST["oldPassword"];
	$np=$_POST["newPassword"];
	$ip=$_SESSION["ip"];
	$timestamp=time();
	$url="https://ssl.captcha.qq.com/ticket/verify?Ticket=".$_POST["Ticket"]."&UserIP=".$ip."&Randstr=".$_POST["Randstr"]."&aid=".TC_APPID."&AppSecretKey=".TC_KEY;
	$capData=file_get_contents($url);
	$capData=json_decode($capData);
	if($capData->response=="1"){
		$user=new User();
		$user->updateObj(uid: $uid);
		echo($user->UpdatePass($op,$np));
	}else{
		echo("孙笑川");
	}
}

if($_POST["f"]=="UpdateInfo"){
	$uid=$_SESSION["uid"];
	
}
?>