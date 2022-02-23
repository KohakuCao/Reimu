<!doctype html>
<?php
session_start();
require($_SERVER['DOCUMENT_ROOT']."config.php");
$_SESSION["ip"] = $_SERVER['REMOTE_ADDR'];
if (isset($_SESSION["uid"])) {
	//header("/index.php");
}
if(isset($_GET["for"])){
	$for=$_GET["for"];
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
	<script type="application/javascript">var TC_APPID=<?php echo(TC_APPID); ?>;</script>
	<script type="application/javascript" src="/js/login.js"></script>
	<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
</head>

<body>
	<div class="bg-img" id="bg-img"></div>
	<main>
		<div class="up-notice" id="up-notice"></div>
		<div class="container mt-5 mb-3" id="logo" onMouseOver="bgBlur();" onMouseOut="bgDeblur();">
			<div class="row justify-content-center">
				<img src="/storage/reimu/logo.svg" class="col-3 col-lg-2 logo-svg" />
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="container main-form col-10 col-lg-4 shadow-lg pb-1" id="main-form" onMouseOver="bgBlur();" onMouseOut="bgDeblur();">

			</div>
		</div>
	</main>
	<footer style="bottom: 0; width: 100%">
	<div class="container-fluid text-white page-footer" style="height: 128px;z-index:-999">
		<h5 class="px-auto text-center">灵Reimu 综合用户中心</h5>
		<p class="text-center">由星云娘DevTeam开发<br />背景人物与Logo设计均源自东方Project，其版权归上海爱丽丝幻乐团与ZUN所有<br />背景图自<a href="https://www.pixiv.net/artworks/34844544">https://www.pixiv.net/artworks/34844544</a></p>
	</div>
	<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=330 height=86 style="display: none;" src="//music.163.com/outchain/player?type=2&id=41652392&auto=1&height=66"></iframe>
	</footer>
	<script type="application/javascript">toLogin();</script>
</body>
</html>