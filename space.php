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
	<script type="application/javascript" src="/js/space.js"></script>
</head>

<body>
	<?php echo($id); ?>
</body>
</html>
