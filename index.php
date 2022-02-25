<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>个人面板 - Reimu</title>
	<link href="/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/css/index.css" rel="stylesheet" />
	<script type="application/javascript" src="/js/bootstrap.bundle.min.js"></script>
	<script type="application/javascript" src="/js/jquery-3.6.0.min.js"></script>
	<script type="application/javascript" src="/js/index.js"></script>
</head>

<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
			<a class="navbar-brand" href="#">NBMUN</a>
		</div>
		<div>
			<u1 class="nav navbar-nav">
			    <li><a href="#">近期活动</a></li>
			    <li><a href="#">核心委员会</a></li>
			    <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				    我的资料
				    <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
				    <li><a href="#">修改头像</a></li>
				    <li class="divider"></li>
				    <li><a href="#">退出登录</a></li>
				</ul>
			    </li>
			</u1>
		    </div>
		</div>
	    </nav>

	    <div class="container">
		<div class="row">
		    <div class="col-xs-2 col-sm-2"></div>
		    <div class="col-xs-8 col-sm-8">
			<div class="mt-1 p-2 bg-primary text-white rounded">
			    <h1>
				<img  src="img/kni.webp" class="rounded-circle m-1 p-1" style="max-height: 96px">
				刀割
			    </h1>
			    <p class="lead">与君初相识，犹如故人归。嗨，别来无恙啊！在这里，你可以编辑您的用户资料！</p>
			    <hr class="my2">
			    <p>你就是歌姬吧！</p>
			</div>
		    </div>
		</div>
	    </div>
	    <div class="container">
		<div class="row">
		    <div class="col-xs-2 col-sm-2 border border-dark p-md-3 p-2 mb-auto rounded">
			<nav class="nav nav-pills nav-stacked">
			    <li>
				<a href="#">个人资料</a>
			    </li>
			    <li>
				<a href="#">头像修改</a>
			    </li>
			    <li>
				<a href="#">面板背景</a>
			    </li>
			    <li>
				<a href="#">修改密码</a>
			    </li>
			    <li>
				<a href="#">退出登录</a>
			    </li>
			</nav>
		    </div>
		    <div class="col-xs-8 col-sm-8">
			<div class="panel panel-default">
			    <div class="panel-heading">
				<h class="panel-title">
				    个人资料
				</h>
			    </div>
			    <div class="panel-body">
				<div class="form-floating mb-3">
				    昵称
				  <input
				    type="text"
				    class="form-control" name="nname" id="nickname" placeholder="起一个友善的昵称吧">
				  <label for="floatingLabel"></label>
				</div>
				<div class="form-floating mb-3">
				    真实姓名
				  <input
				    type="text"
				    class="form-control" name="name" id="Name" placeholder="">
				  <label for="floatingLabel"></label>
				</div>
				<div class="form-floating mb-3">
				    身份证号
				  <input
				    type="text"
				    class="form-control" name="id" id="Identi" placeholder="我们会保护您的隐私">
				  <label for="floatingLabel"></label>
				</div>
				<div class="form-floating">
				    性别
				    <input
				    type="radio"
				    name="sex" id="sex" placeholder="建议使用生理性别" value="male">男
				    <input
				    type="radio"
				    name="sex" id="sex" placeholder="建议使用生理性别" value="female">女
				    <label for="floatingLabel"></label>
				</div>
				<hr class="my-4">
				<div class="form-floating mb-3">
				    电子邮箱
				    <input
				    type="email"
				    class="form-control" name="email" id="email" placeholder="邮箱将用于发送通知~">
				    <label for="floatingLabel"></label>
				</div>
				<div class="form-floating mb-3">
				    手机号码
				    <input
				    type="number"
				    class="form-control" name="phone" id="phone" placeholder="手机将用于发送通知~">
				    <label for="floatingLabel"></label>
				</div>
				<div class="form-floating mb-3">
				    QQ
				    <input
				    type="number"
				    class="form-control" name="qq" id="qq" placeholder="我们的总群在QQ哦">
				    <label for="floatingLabel"></label>
				</div>
				<div class="mb-3">
				  <label for="" class="form-label"></label>
				  个性签名
				  <input type="text" name="note" id="note" class="form-control" placeholder="一句话的个性签名" aria-describedby="helpId">
				</div>
			    </div>
			</div>
		    </div>
		</div>
    </div>

	
	
	<main>
	</main>
	<footer style="bottom: 0; width: 100%">
	<div class="container-fluid bg-dark text-white" style="height: 48px;z-index:-999">
		<h5 class="px-auto text-center">Reimu</h5>
	</div>
	</footer>
</body>
</html>
