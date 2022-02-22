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
	<script type="application/javascript" src="/js/login.js"></script>
</head>

<body>
	<main>
		<div class="bg-img" id="bg-img"></div>
		<div class="container"></div>
	</main>
	<footer style="bottom: 0; width: 100%">
	<div class="container-fluid bg-dark text-white" style="height: 96px">
		<h5 class="px-auto text-center">Reimu</h5>
	</div>
</footer>
</body>
</html>