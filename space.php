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
        <div class="container mt-5">
            <h2>个人名片<br><br></h2>
            <div class="row">
                <div class="col-xs-1 col-sm-1"></div>
                <div class="card border border-0" style="height: 45%;width:80%">
                    <img class="card-img-top" src="img/space.png" alt="Card image" style=" -webkit-filter: blur(15px);filter:blur(15px)">
                    <div class="p-5 card-body text-shadow text-white rounded card-img-overlay"> 
                        <h id="Info">
                            <img class="rounded-circle pl-2 py-2" style="max-height:35%" src="img/kni.webp">
                            <b id="IDname" class="p-4 h4">刀割
                                <b id="ID" class="h6">id:<a>20220001</a></b>
                            </b>
                        </h1>
                        <hr class="my-2">
                        <p>NBMUN东百好果子公司名誉董事</p>
                        <hr class="my-2">
                        <p>你就是个歌姬吧！<br></p>
                        <br>
                        <img src="img/kni.webp" style="height: 20%; bottom:10%; right:10%" class="float-end">
                    </div>
                    
                </div>
            </div>
            <p><br><br></p>
	</div>
	<main>
	</main>
	<footer style="bottom: 0; width: 100%">
	<div class="container-fluid bg-dark text-white" style="height: 96px;z-index:-999">
		<h5 class="px-auto text-center">Reimu</h5>
	</div>
	</footer>
</body>
</html>
