<?php
session_start();
require($_SERVER["DOCUMENT_ROOT"]."config.php");
class User{
	public $uid;
	public $username;
	public $name;
	public $sex;
	public $phone;
	public $email;
	public $identity;
	public $qq;
	public $school;
	public $introduction;
	public $sign;

	function updateObj($uid=0,$username="",$name="",$sex=0,$phone=0,$email="",$identity="",$qq=0,$school="",$introduction="",$sign=""){
		$this->uid=$uid;
		$this->username=$username;
		$this->name=$name;
		$this->sex=$sex;
		$this->phone=$phone;
		$this->email=$email;
		$this->identity=strtoupper($identity);
		$this->qq=$qq;
		$this->school=$school;
		$this->introduction=$introduction;
		$this->sign=$sign;
	}

	function Check(){
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		$query=mysqli_query($myConnect,"SELECT id FROM `user` WHERE `username`='$this->username';");
		if(mysqli_num_rows($query)!=0){
			echo("username");
		}
		$query=mysqli_query($myConnect,"SELECT id FROM `user` WHERE `phone`='$this->phone';");
		if(mysqli_num_rows($query)!=0){
			echo("phone");
		}
		$query=mysqli_query($myConnect,"SELECT id FROM `user` WHERE `email`='$this->email';");
		if(mysqli_num_rows($query)!=0){
			echo("email");
		}
		$query=mysqli_query($myConnect,"SELECT id FROM `user` WHERE `identity`='$this->identity';");
		if(mysqli_num_rows($query)!=0){
			echo("identity");
		}

		mysqli_close($myConnect);
		return 0;
	}

	function Login($login="",$password="",$ip="0.0.0.0"){
		$name=htmlspecialchars($login);
		$phone=intval($name);
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		$query=mysqli_query($myConnect,"SELECT id,password FROM `user` WHERE `username`='$name' OR `phone`=$phone OR `email`='$name';");
		if(mysqli_num_rows($query)==0){
			return 0;
		}
		$result=mysqli_fetch_array($query);
		if(password_verify($password,$result["password"])){
			$id=intval($result["id"]);
			$_SESSION["uid"]=intval($result["id"]);
			mysqli_query($myConnect,"UPDATE `user` SET `last_IP`='$ip' WHERE `id`=$id;");
			mysqli_close($myConnect);
			return 1;
		}else{
			mysqli_close($myConnect);
			return 0;
		}
	}
	
	function Register($password="",$ip="0.0.0.0"){
	
	}
}
?>