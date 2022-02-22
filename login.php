<!doctype html>
<?php
session_start();
if (isset($_SESSION["uid"])) {
	header("/index.php");
}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>登录 - Reimu</title>
	<link href="/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/css/login.css" rel="stylesheet" />
	<script type="application/javascript" src="/js/bootstrap.bundle.min.js"></script>
</head>

<body>
	
</body>
</html>