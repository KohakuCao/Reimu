<?php
session_start();
require($_SERVER["DOCUMENT_ROOT"]."config.php");
class User{
	//初始化对象属性
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
		//更新对象属性
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
		//检查是否存在相同用户
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
		//登录
		$name=htmlspecialchars($login);//防止注入
		$phone=intval($name);
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		$query=mysqli_query($myConnect,"SELECT id,password FROM `user` WHERE `username`='$name' OR `phone`=$phone OR `email`='$name';");
		if(mysqli_num_rows($query)==0){
			mysqli_close($myConnect);
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
		//注册
		if($this->Check()!=0){
			return 0;
		}
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		$check=mysqli_query($myConnect,"SELECT reg_time FROM `user` WHERE `reg_IP`='$ip';");
		if(mysqli_num_rows($check)>0){
			$check=mysqli_fetch_array($check);
			if(strtotime($check["reg_time"])+strtotime("+1day")>time()){
				mysqli_close($myConnect);
				return 0;
			}
		}
		$password=password_hash($password,PASSWORD_BCRYPT,["cost"=>10]);
		$sen="INSERT INTO `user` (username,name,password,sex,phone,email,qq,reg_IP) VALUES ('$this->username','$this->name','$password',0,$this->phone,'$this->email',$this->qq,'$ip');";
		if(mysqli_query($myConnect,$sen)){
			return 1;
		}else{
			return 0;
		}
	}
	
	function GetInfo(){
		//从数据库获取信息，并为对象设置属性
		$uid=$this->uid;
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		$query=mysqli_query($myConnect,"SELECT * FROM `user` WHERE `id`=$uid;");
		$result=mysqli_fetch_array($query);
		$this->updateObj($uid,$result["username"],$result["name"],intval($result["sex"]),intval($result["phone"]),$result["email"],$result["identity"],intval($result["qq"]),$result["school"],$result["introduction"],$result["sign"]);
		return true;
	}
	
	function UpdateInfo($s=["phone"=>0,"email"=>0,"qq"=>0]){
		//修改资料
		$uid=$this->uid;
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		$p=$s["phone"];
		$e=$s["email"];
		$q=$s["qq"];
		if(mysqli_query($myConnect,"UPDATE `user` SET `sex`=$this->sex,`phone`=$this->phone,`email`='$this->email',`qq`=$this->qq,`school`='$this->school',`identity`='$this->identity',`school`='$this->school',`introduction`='$this->introduction',`sign`='$this->sign' WHERE `id`=$uid;") && mysqli_query($myConnect,"UPDATE `info_display` SET `phone`=$p,`email`=$e,`qq`=$q WHERE `id`=$uid;")){
			mysqli_close($myConnect);
			return 1;
		}else{
			return 0;
		}
	}
	
	function GetExperience(){
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		$result=mysqli_query($myConnect,"SELECT * FROM `experience` WHERE `uid`=$this->uid;");
		if(mysqli_num_rows($result)==0){
			mysqli_close($myConnect);
			return 0;
		}
		$exp=[];
		while($row=mysqli_fetch_array($result)){
			array_push($exp,$row);
		}
		mysqli_close($myConnect);
		return $exp;
	}
	
	function AddExperience(array $exp){
		$name=$exp["name"];
		$committee=$exp["committee"];
		$topic=$exp["topic"];
		$seat=$exp["seat"];
		$title=$exp["title"];
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		$sen="INSERT INTO `experience` (uid,name,committee,topic,seat,title) VALUES ($this->uid,'$name','$committee','$topic','$seat','$title');";
		if(mysqli_query($myConnect,$sen)){
			mysqli_close($myConnect);
			return 1;
		}else{
			mysqli_close($myConnect);
			return 0;
		}
	}
	
	function DeleteExperience($id){
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		if(mysqli_query($myConnect,"DELETE FROM `experience` WHERE `id`=$id;")){
			mysqli_close($myConnect);
			return 1;
		}else{
			mysqli_close($myConnect);
			return 0;
		}
	}
	
	function UpdatePass($op,$np){
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		$query=mysqli_query($myConnect,"SELECT password FROM `user` WHERE `id`=$this->uid;");
		$result=mysqli_fetch_array($query);
		if(password_verify($op,$result["password"])){
			$np=password_hash($np,PASSWORD_BCRYPT,["cost"=>10]);
			$query=mysqli_query($myConnect,"UPDATE `user` SET `password`='$np' WHERE `id`=$this->uid;");
			if($query){
				mysqli_close($myConnect);
				return 1;
			}else{
				mysqli_close($myConnect);
				return 0;
			}
		}else{
			mysqli_close($myConnect);
			return 0;
		}
	}
}
?>