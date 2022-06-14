<!doctype html>
<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."config.php");
$_SESSION["ip"] = $_SERVER['REMOTE_ADDR'];

if(isset($_GET["app"])&&isset($_GET["redirect"])){
	$app=strtolower($_GET["app"]);
	$redirect=$_GET["redirect"];
	$myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB);
	if(mysqli_num_rows(mysqli_query($myConnect,"SELECT * FROM `oauth_app` WHERE `app`='$app';"))==0){
		header("Location: /403.html");
	}
	if (isset($_SESSION["uid"])) {
		$uid=intval($_SESSION["uid"]);
		$q=mysqli_query($myConnect,"SELECT * FROM `oauth` WHERE `uid`=$uid;");
		if(mysqli_num_rows($q)>0){
			$time=time();
			$code=md5(rand());
			mysqli_query($myConnect,"UPDATE `oauth` SET `time`=$time,`code`='$code' WHERE `uid`=$uid;");
			header("Location:".$redirect."?code=".$code);
		}else{
			$time=time();
			$code=md5(rand());
			$token=hash("sha512",$uid.$code.$time);
			mysqli_query($myConnect,"INSERT INTO `oauth` (`uid`,`code`,`token`,`time`) VALUES ($uid,'$code','$token',$time);");
			header("Location:".$redirect."?code=".$code);
		}
	}
	mysqli_close($myConnect);
}else{
	if (isset($_SESSION["uid"])) {
		header("Location: /");
	}
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>登录 - Reimu</title>
	<link href="/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/css/login.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<script type="application/javascript" src="/js/bootstrap.bundle.min.js"></script>
	<script type="application/javascript" src="/js/jquery-3.6.0.min.js"></script>
	<script type="application/javascript">
		var TC_APPID=<?php echo(TC_APPID); ?>;
		<?php
		if(isset($_GET["app"])&&isset($_GET["redirect"])){
			echo('
			var app="'.$app.'";
			var redirect="'.$redirect.'";
			var oauth=true;
			');
		}else{
			echo("var oauth=false;");
		}
		?>
	</script>
	<script type="application/javascript" src="/js/login.js"></script>
	<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
</head>

<body>
	<div class="bg-img" id="bg-img"></div>
	<main>
		<div class="up-notice" id="up-notice"></div>
		<div class="container mt-5 mb-3" id="logo">
			<div class="row justify-content-center">
				<img src="/storage/reimu/logo.svg" class="col-3 col-lg-2 logo-svg" onMouseOver="bgBlur();" onMouseOut="bgDeblur();" />
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="container main-form col-10 col-lg-4 shadow-lg pb-1" id="main-form" onMouseOver="bgBlur();" onMouseOut="bgDeblur();">

			</div>
		</div>
	</main>
	<footer style="bottom: 0; width: 100%">
	<div class="container-fluid text-white page-footer" style="height: 152px;z-index:-999">
		<h5 class="px-auto text-center">灵Reimu 用户中心</h5>
		<p class="text-center">由星云娘~DevTeam~开发，背景与Logo均源自东方Project，著作权归上海爱丽丝幻乐团与ZUN所有<br />背景图自<a href="https://www.pixiv.net/artworks/80453394">https://www.pixiv.net/artworks/80453394</a><br /><a href="https://beian.miit.gov.cn">京ICP备2022009339号-3</a><br/><a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010802039245"><img src="https://nbmun.cn/wp-content/uploads/2022/04/2022-04-14_23-12-54_472354.png">京公网安备 11010802039245号</a></p>

	</div>
	<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=330 height=86 style="display: none;" src="//music.163.com/outchain/player?type=2&id=774476&auto=1&height=66"></iframe>
	</footer>
	<script type="application/javascript">toLogin();</script>
</body>
</html>