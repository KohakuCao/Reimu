<!doctype html>
<?php
session_start();
$id=(function(){
	if($_GET["uid"]){
		return(intval($_GET["uid"]));
	}else{
		return(0);
	}
})();
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> - Reimu模联名片</title>
	<link href="/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/css/space.css" rel="stylesheet" />
	<script type="application/javascript" src="/js/bootstrap.bundle.min.js"></script>
	<script type="application/javascript" src="/js/jquery-3.6.0.min.js"></script>
	<script type="application/javascript" src="/js/space.js"></script>
</head>

<body>
	<?php echo($id); ?>
	<main>
	</main>
	<footer style="bottom: 0; width: 100%">
	<div class="container-fluid bg-dark text-white" style="height: 96px;z-index:-999">
		<h5 class="px-auto text-center">Reimu</h5>
	</div>
	</footer>
</body>
</html>
