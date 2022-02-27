<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."includes/user.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]."includes/upload.class.php");
//ini_set("display_errors","no");
if($_POST["f"]=="Check"){
	if(isset($_SESSION["uid"])){
		$uid=$_SESSION["uid"];
	}else{
		$uid=0;
	}
	$username=$_POST["username"];
	$phone=$_POST["phone"];
	$email=$_POST["email"];
	$identity=$_POST["identity"];
	$user=new User();
	$user->updateObj(uid:$uid, username: $username,phone: $phone,email: $email,identity: $identity);
	$user->Check();
}

if($_POST["f"]=="Reg"){
	$username=htmlspecialchars($_POST["username"]);
	$name=htmlspecialchars($_POST["name"]);
	$phone=intval(htmlspecialchars($_POST["phone"]));
	$email=htmlspecialchars($_POST["email"]);
	$qq=intval(htmlspecialchars($_POST["qq"]));
	$password=$_POST["password"];
	if($username==""||$name==""||$phone==null||$email==""||$qq==null){
		echo("0");
	}
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
	$uid=intval($_SESSION["uid"]);
	$sex=intval($_POST["sex"]);
	$phone=intval($_POST["phone"]);
	$email=htmlspecialchars($_POST["email"]);
	$qq=intval($_POST["qq"]);
	$identity=htmlspecialchars($_POST["identity"]);
	$school=htmlspecialchars($_POST["school"]);
	$introduction=htmlspecialchars($_POST["introduction"]);
	$sign=htmlspecialchars($_POST["sign"]);
	if(strlen($sign)>100){
		$sign=mb_substr($sign,0,99)."……";
	}
	$s=[
		"phone"=>intval($_POST["phone_display"]),
		"email"=>intval($_POST["email_display"]),
		"qq"=>intval($_POST["qq_display"])
	];
	$user=new User();
	$user->updateObj($uid,"","",$sex,$phone,$email,$identity,$qq,$school,$introduction,$sign);
	echo($user->UpdateInfo($s));
}

if($_POST["f"]=="GetExp"){
	$uid=$_SESSION["uid"];
	$user=new User();
	$user->updateObj(uid:$uid);
	$exps=$user->GetExperience();
	if($exps==0){
		echo("您还没有参加过模联会议！");
	}else{
		echo('<div class="accordion" id="exp">');
		foreach($exps as $e) {
			if ($e["committee"] != "") {
				$e["committee"] = $e["committee"] . "<br />";
			}
			if ($e["topic"] != "") {
				$e["topic"] = $e["topic"] . "<br />";
			}
			$output = '<div class="accordion-item">
							<h2 class="accordion-header" id="expHead' . $e["id"] . '">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#exp' . $e["id"] . '" aria-expanded="false" aria-controls="exp' . $e["id"] . '">
							' . $e["name"] . '
							</button>
							</h2>
							<div id="exp' . $e["id"] . '" class="accordion-collapse collapse" aria-labelledby="expHead' . $e["id"] . '" >
							<div class="accordion-body">
							<strong>委员会：' . $e["committee"] . '</strong>' . $e["topic"] . $e["seat"] . '<br />' . $e["title"] . '
							<div class="row p-0 m-0 justify-content-end"><button onclick="delExp('.$e["id"].');" class="btn btn-danger col-3 col-md-2">删除</button></div>
							</div>
							</div>
							</div>';
			echo($output);
		}
			echo("</div>");
			unset($e);
	}
}

if($_POST["f"]=="AddExp"){
	$uid=$_SESSION["uid"];
	$name=htmlspecialchars($_POST["name"]);
	$committee=htmlspecialchars($_POST["committee"]);
	$topic=htmlspecialchars($_POST["topic"]);
	$seat=htmlspecialchars($_POST["seat"]);
	$title=htmlspecialchars($_POST["title"]);
	if($name!=""||$seat!=""){
		$exp=[
			"name"=>$name,
			"committee"=>$committee,
			"topic"=>$topic,
			"seat"=>$seat,
			"title"=>$title
		];
		$user=new User();
		$user->updateObj(uid: $uid);
		echo($user->AddExperience($exp));
	}else{
		echo(0);
	}
}

if($_POST["f"]=="DelExp"){
	$id=$_POST["id"];
	if(!isset($_SESSION["uid"])){
		echo(0);
		exit();
	}
	$user=new User();
	$user->updateObj(uid:$_SESSION["uid"]);
	echo($user->DeleteExperience($id));
}

if($_POST["f"]=="DisExp"){
	$e=intval($_POST["experience_display"]);
	$user=new User();
	$user->updateObj(uid:$_SESSION["uid"]);
	echo($user->DisplayExperience($e));
}

if($_POST["f"]=="Logout"){
	session_destroy();
	echo("1");
}

if($_POST["f"]=="UpdateAva"){
	if(empty($_FILES["newAva"]["tmp_name"])||stristr($_FILES["newAva"]["type"],"image/")==false){
		header("Location:/");
		exit();
	}
	$file=$_FILES["newAva"];
	$uid=$_SESSION["uid"];
	$ava=new Upload($file,"ava");
	if($ava->UpdateAvatar($uid)){
		header("Location:/");
	}
	
}

if($_POST["f"]=="UpdateBg"){
	if(empty($_FILES["newBg"]["tmp_name"])||stristr($_FILES["newBg"]["type"],"image/")==false){
		header("Location:/");
		exit();
	}
	$file=$_FILES["newBg"];
	$uid=$_SESSION["uid"];
	$ava=new Upload($file,"bg");
	if($ava->UpdateBackground($uid)){
		header("Location:/");
	}
}
?>