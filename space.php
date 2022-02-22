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
<title> - 模联名片</title>
</head>

<body>
	<?php echo($id); ?>
</body>
</html>
