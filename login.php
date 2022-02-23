<!doctype html>
<?php
session_start();
if (isset($_SESSION["uid"])) {
	header("/index.php");
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
	<script type="application/javascript" src="/js/bootstrap.bundle.min.js"></script>
	<script type="application/javascript" src="/js/jquery-3.6.0.min.js"></script>
	<script type="application/javascript" src="/js/login.js"></script>
</head>

<body>
	<div class="bg-img" id="bg-img"></div>
	<main>
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
	<div class="container-fluid bg-dark text-white" style="height: 96px;z-index:-999">
		<h5 class="px-auto text-center">Reimu</h5>
	</div>
	<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=330 height=86 style="display: none;" src="//music.163.com/outchain/player?type=2&id=41652392&auto=1&height=66"></iframe>
	</footer>
	<script type="application/javascript">toLogin();</script>
</body>
</html>