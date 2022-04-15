<?php
require_once($_SERVER["DOCUMENT_ROOT"]."config.php");
class Wechat{
	public $wid=WECHAT_APPID;
	public $wsec=WECHAT_SECRET;

	public function getToken(){
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->wid."&secret=".$this->wsec;
		$exp=time()+7200;
		$token=file_get_contents($url);
		$token=json_decode($token,true);
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		mysqli_query($myConnect,"UPDATE `wechat_token` SET `ex`='$exp',`token`='".$token["access_token"]."' WHERE `id`=1;");
		mysqli_close($myConnect);
		return $token["access_token"];
	}

	public function getTickect($token){
		$url="https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$token."&type=jsapi";
		$exp=time()+7200;
		$ticket=file_get_contents($url);
		$ticket=json_decode($ticket,true);
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		mysqli_query($myConnect,"UPDATE `wechat_token` SET `ex`='$exp',`token`='".$ticket["ticket"]."' WHERE `id`=2;");
		mysqli_close($myConnect);
		return $ticket["ticket"];
	}

	public function outputTicket(){
		$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
		$check=mysqli_query($myConnect,"SELECT * FROM `wechat_token` WHERE `id`=2;");
		$check=mysqli_fetch_array($check);
		if(intval($check["ex"])<=time()){
			$check=mysqli_query($myConnect,"SELECT * FROM `wechat_token` WHERE `id`=1;");
			$check=mysqli_fetch_array($check);
			if(intval($check["ex"])<=time()){
				$token=$this->getToken();
				$ticket=$this->getTickect($token);
			}else{
				$ticket=$this->getTickect($check["token"]);
			}
		}else{
			$ticket=$check["token"];
		}
		mysqli_close($myConnect);
		return $ticket;
	}

	public function sign($timestamp,$randstr,$ticket,$url){
		$str="jsapi_ticket=".$ticket."&noncestr=".$randstr."&timestamp=".$timestamp."&url=".$url;
		return sha1($str);
	}
}
?>