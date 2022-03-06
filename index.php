<!doctype html>
<?php
session_start();
if ( !isset( $_SESSION[ "uid" ] ) ) {
	header( "Location:/login" );
	exit();
} else {
	$uid = intval( $_SESSION[ "uid" ] );
}
require_once( $_SERVER[ "DOCUMENT_ROOT" ] . "includes/user.class.php" );
$user = new User();
$user->updateObj( uid: $uid );
$display = $user->GetInfo();
if ( file_exists( $_SERVER[ "DOCUMENT_ROOT" ] . "storage/avatar/" . $uid . ".gif" ) ) {
	$avatar = $uid . ".gif";
} elseif ( file_exists( $_SERVER[ "DOCUMENT_ROOT" ] . "storage/avatar/" . $uid . ".png" ) ) {
	$avatar = $uid . ".png";
} else {
	$avatar = "0.png";
}
if ( file_exists( $_SERVER[ "DOCUMENT_ROOT" ] . "storage/bg/" . $uid . ".jpg" ) ) {
	$bg = $uid . ".jpg";
} else {
	$bg = "0.jpg";
}
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache,no-store,must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<title>个人面板 - Reimu</title>
<link href="/css/bootstrap.min.css" rel="stylesheet" />
<link href="/css/index.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<script type="application/javascript" src="/js/bootstrap.bundle.min.js"></script> 
<script type="application/javascript" src="/js/jquery-3.6.0.min.js"></script> 
<script type="application/javascript" src="/js/index.js"></script>
<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow" role="navigation">
	<div class="container-fluid"> <a class="navbar-brand" href="/"><img class="logo" src="/storage/reimu/logo.svg" /></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<u1 class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="<?php echo("/s/".$uid); ?>">我的模联名片</a></li>
				<li class="nav-item"><a class="nav-link" href="#">表白墙</a></li>
				<li class="nav-item dropdown"> <a href="/" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> 我的资料 <b class="caret"></b> </a>
					<ul class="dropdown-menu">
						<li><a  class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">退出登录</a></li>
					</ul>
				</li>
			</u1>
		</div>
	</div>
</nav>
<main>
	<div class="up-notice" id="up-notice"></div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="my-3 p-4 text-white rounded user-card shadow" style="background: url(/storage/bg/<?php echo($bg); ?>) center no-repeat;">
					<h1 class="text-shadow"><img src="/storage/avatar/<?php echo($avatar); ?>" class="rounded-circle mx-2 p-1 img-shadow" style="height: 96px;width: 96px"><?php echo($user->name); ?></h1>
					<p class="lead text-shadow">用户名：<?php echo($user->username); ?></p>
					<hr class="my2">
					<p class="text-shadow"><?php echo($user->sign); ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-3 border border-dark p-1 p-md-3 mb-auto rounded">
				<div class="nav nav-pills flex-column" id="pills-tab" role="tablist" aria-orientation="vertical">
					<button class="nav-link side-bar active" id="info-tab" data-bs-toggle="pill" data-bs-target="#info-panel" type="button" role="tab" aria-controls="info-panel" aria-selected="true">个人资料</button>
					<button class="nav-link side-bar" id="experience-tab" data-bs-toggle="pill" data-bs-target="#experience-panel" type="button" role="tab" aria-controls="experience-panel" aria-selected="true">参会经历</button>
					<button class="nav-link side-bar" id="avatar-tab" data-bs-toggle="pill" data-bs-target="#avatar-panel" type="button" role="tab" aria-controls="avatar-panel" aria-selected="false">修改头像</button>
					<button class="nav-link side-bar" id="bg-tab" data-bs-toggle="pill" data-bs-target="#bg-panel" type="button" role="tab" aria-controls="bg-panel" aria-selected="false">名片背景</button>
					<button class="nav-link side-bar" id="pass-tab" data-bs-toggle="pill" data-bs-target="#pass-panel" type="button" role="tab" aria-controls="pass-panel" aria-selected="false">修改密码</button>
					<button class="nav-link side-bar" data-bs-toggle="modal" data-bs-target="#logoutModal">退出登录</button>
				</div>
			</div>
			<div class="col-9">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="info-panel" role="tabpanel" aria-labelledby="info-tab">
						<h4> 个人资料 </h4>
						<div class="py-4 pe-1">
							<form id="information">
								<div class="mb-3 row">
									<label class="col-3 col-form-label" for="username">用户名</label>
									<div class="col-9">
										<input type="text" class="form-control-plaintext" id="username" readonly value="<?php echo($user->username); ?>" aria-describedby="usernameHelp" />
									</div>
									<label id="usernameHelp" class="form-text">用户名不可更改</label>
								</div>
								<div class="mb-3 row">
									<label class="col-3 col-form-label" for="username">姓名</label>
									<div class="col-9">
										<input type="text" class="form-control-plaintext" id="name" readonly value="<?php echo($user->name); ?>" aria-describedby="nameHelp" />
									</div>
									<label id="usernameHelp" class="form-text">姓名不可更改</label>
								</div>
								<div class="mb-1">
									<label class="form-label" for="identity">身份证号</label>
									<input type="text" class="form-control" id="identity" placeholder="我们会保护您的隐私" aria-describedby="identityHelp" value="<?php echo($user->identity); ?>" onChange="check();">
									<label id="identityHelp" class="form-text"></label>
								</div>
								<div class="mb-3">
									<label class="form-label" for="sex">性别</label>
									<select class="form-select" form="information" id="sex">
										<option id="sex0" value="0" <?php if($user->sex==0){echo("selected");} ?>>---建议使用生物学性别---</option>
										<option id="sex1" value="1" <?php if($user->sex==1){echo("selected");} ?>>男</option>
										<option id="sex2" value="2" <?php if($user->sex==2){echo("selected");} ?>>女</option>
										<option id="sex3" value="3" <?php if($user->sex==3){echo("selected");} ?>>魂魄妖梦</option>
									</select>
								</div>
								<div class="mb-1">
									<label class="form-label" for="school">学校</label>
									<input type="text" class="form-control" id="school" placeholder="北京航空职业技术学院" aria-describedby="schoolHelp" value="<?php echo($user->school); ?>">
									<label id="schoolHelp" class="form-text"></label>
								</div>
								<hr class="my-4">
								<div class="mb-3">
									<label class="form-label" for="email">邮箱</label>
									<input type="text" class="form-control" id="email" aria-describedby="emailHelp" value="<?php echo("$user->email"); ?>" onChange="check();" />
									<label class="form-text" id="emailHelp"></label>
									<input class="form-check-input" type="checkbox" id="email_display" <?php if($display["email"]==1){echo("checked");} ?> />
									<label class="form-check-label" for="email_display">在名片展示</label>
								</div>
								<div class="mb-3">
									<label class="form-label" for="phone">手机</label>
									<input type="tel" class="form-control" id="phone" aria-describedby="phoneHelp" value="<?php echo("$user->phone"); ?>" onChange="check();" />
									<label class="form-text" id="phoneHelp"></label>
									<input class="form-check-input" type="checkbox" id="phone_display" <?php if($display["phone"]==1){echo("checked");} ?> />
									<label class="form-check-label" for="phone_display">在名片展示</label>
								</div>
								<div class="mb-3">
									<label class="form-label" for="qq">QQ</label>
									<input type="tel" class="form-control" id="qq" aria-describedby="qqHelp" value="<?php echo("$user->qq"); ?>" />
									<label class="form-text" id="qqHelp"></label>
									<input class="form-check-input" type="checkbox" id="qq_display" <?php if($display["qq"]==1){echo("checked");} ?> />
									<label class="form-check-label" for="qq_display">在名片展示</label>
								</div>
								<div class="mb-3">
									<label class="form-label" for="wechat">微信</label>
									<input type="tel" class="form-control" id="wechat" aria-describedby="wechatHelp" value="<?php echo("$user->wechat"); ?>" />
									<label class="form-text" id="wechatHelp"></label>
									<input class="form-check-input" type="checkbox" id="wechat_display" <?php if($display["wechat"]==1){echo("checked");} ?> />
									<label class="form-check-label" for="wechat_display">在名片展示</label>
								</div>
								<hr class="my-4">
								<div class="mb-3">
									<label for="sign" class="form-label">个性签名</label>
									<input type="text" id="sign" class="form-control" placeholder="一句话的个性签名" aria-describedby="signHelp" value="<?php echo("$user->sign"); ?>" />
									<label class="form-text" id="signHelp">不可超过100字</label>
								</div>
								<div class="mb-3">
									<label for="introductin" class="form-label">个人简介</label>
									<textarea class="form-control" id="introduction" aria-describedby="introHelp" rows="4"><?php echo("$user->introduction"); ?></textarea>
									<label class="form-text" id="introHelp"></label>
								</div>
							</form>
							<div class="row justify-content-end">
								<button class="mt-2 mb-5 btn btn-primary col-3 col-md-2" onClick="updateInfo();"><i class="bi bi-send-fill"></i>保存</button>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="experience-panel" role="tabpanel" aria-labelledby="experience-tab">
						<div class="row justify-content-end my-2 px-4">
							<div class="col-6 col-md-4 col-lg-3">
								<input class="form-check-input" type="checkbox" id="exp_display" <?php if($display["experience"]==1){echo("checked");} ?> />
									<label class="form-check-label" for="exp_display">在名片展示</label>
							</div>
							<button class="col-2 col-md-1 btn btn-success" onClick="saveDisExp();"><i class="bi bi-file-earmark-text"></i></button>
						</div>
						<div class="px-1" id="exps"></div>
						<hr class="my-4" />
						<div class="py-2 pe-1">
							<h4>添加参会经历</h4>
							<form>
								<div class="form-floating mb-1">
									<input type="text" class="form-control" id="e-name" aria-describedby="e-nameHelp" placeholder="必填" />
									<label class="form-text" id="e-nameHelp"></label>
									<label for="e-name">会议名*</label>
								</div>
								<div class="form-floating mb-1">
									<input type="text" class="form-control" id="e-committee" aria-describedby="e-committeeHelp" placeholder="选填" />
									<label  for="e-committee">委员会（非必填）</label>
									<label class="form-text" id="e-committeeHelp"></label>
								</div>
								<div class="form-floating mb-1">
									<input type="text" class="form-control" id="e-topic" aria-describedby="e-topicHelp" placeholder="选填" />
									<label for="e-topic">议题（非必填）</label>
									<label class="form-text" id="e-topicHelp"></label>
								</div>
								<div class="form-floating mb-1">
									<input type="text" class="form-control" id="e-seat" aria-describedby="e-seatHelp" placeholder="选填" />
									<label for="e-seat">席位或职位*</label>
									<label class="form-text" id="e-seatHelp"></label>
								</div>
								<div class="form-floating mb-1">
									<input type="text" class="form-control col-6" id="e-title" aria-describedby="e-titleHelp" placeholder="选填" />
									<label for="e-title">奖项或称号（非必填）</label>
									<label class="form-text" id="e-titleHelp"></label>
								</div>
							</form>
							<div class="row justify-content-end">
								<button class="mt-2 mb-5 btn btn-primary col-3 col-md-2" id="sendExp" onClick="sendExp();"><i class="bi bi-send-fill"></i>添加</button>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="avatar-panel" role="tabpanel" aria-labelledby="avatar-tab">
						<div class="container space-2">
							<div class="row">
								<div class="col col-12 col-md-6 col-lg-7 mb-5">
									<h5 class="mb-4 text-center">原头像</h5>
									<div class="img-container"> <img class="mx-auto" id="image" src="/storage/avatar/<?php echo($avatar); ?>" style="max-height:256px;max-width:256px;" /> </div>
								</div>
								<div class="col col-12 col-md-6 col-lg-5">
									<h5 class="text-center">新头像</h5>
									<div class="text-center">
									<form id="avatar-form" action="/includes/query.php" method="post" enctype="multipart/form-data">
										<label for="newAva" class="form-label">选择图片</label>
										<input id="f" name="f" type="text" value="UpdateAva" readonly style="display: none" />
										<input id="newAva" name="newAva" type="file" accept="image/*" class="form-control" onChange="checkSize('ava');" />
										<label class="form-text text-danger" id="avaHelp"></label>
										<button type="submit" class="btn btn-primary my-4" name="avatar-save"><i class="bi bi-send-fill"></i>保存</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="bg-panel" role="tabpanel" aria-labelledby="bg-tab">
						<div class="container space-2">
							<div class="row">
								<div class="col col-12 col-md-6 col-lg-7 mb-5">
									<h5 class="mb-4 text-center">原背景</h5>
									<div class="img-container"> <img class="mx-auto" id="image" src="/storage/bg/<?php echo($bg); ?>" style="max-height:256px;max-width:100%;" /> </div>
								</div>
								<div class="col col-12 col-md-6 col-lg-5">
									<h5 class="text-center">新背景</h5>
									<div class="text-center">
									<form id="bg-form" action="/includes/query.php" method="post" enctype="multipart/form-data">
										<label for="newBg" class="form-label">选择图片</label>
										<input id="f" name="f" type="text" value="UpdateBg" readonly style="display: none" />
										<input id="newBg" name="newBg" type="file" accept="image/*" class="form-control" onChange="checkSize('bg');" />
										<label class="form-text text-danger" id="bgHelp"></label>
										<button type="submit" class="btn btn-primary my-4" name="bg-save"><i class="bi bi-send-fill"></i>保存</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="pass-panel" role="tabpanel" aria-labelledby="pass-tab">
						<form class="mt-4">
							<div class="form-floating mb-1">
									<input type="password" class="form-control" id="oldPass" aria-describedby="oldPassHelp" placeholder="旧密码" />
									<label class="form-text" id="oldPassHelp"></label>
									<label for="oldPass">旧密码</label>
								</div>
								<div class="form-floating mb-1">
									<input type="password" class="form-control" id="newPass" aria-describedby="newPassHelp" placeholder="新密码" />
									<label  for="newPass">新密码</label>
									<label class="form-text" id="newPassHelp"></label>
								</div>
								<div class="form-floating mb-1">
									<input type="password" class="form-control" id="newPass2" aria-describedby="newPass2Help" placeholder="新密码" />
									<label  for="newPass2">重复输入新密码</label>
									<label class="form-text" id="newPass2Help"></label>
								</div>
						</form>
						<div class="row justify-content-end">
							<button class="mt-2 mb-5 btn btn-primary col-3 col-md-2" id="TencentCaptcha" data-appid="<?php echo(TC_APPID); ?>" data-cbfn="updatePass" type="button"><i class="bi bi-send-fill"></i>保存</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="logoutModalLabel">退出登录</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>您即将退出登录。</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
				<button type="button" class="btn btn-danger" onClick="Logout();">退出</button>
			</div>
		</div>
	</div>
</div>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
	<div id="updateSucToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-header"> <img src="/storage/reimu/logo.svg" class="rounded me-2" style="width: 24px;height: 24px" /> <strong class="me-auto">灵Reimu</strong> <small>现在</small>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">
			<p>修改成功</p>
		</div>
	</div>
</div>
<footer style="bottom: 0; width: 100%">
	<div class="container-fluid bg-dark text-white" style="height: 96px;z-index:-999">
		<h5 class="px-auto text-center">Reimu</h5>
		<p class="text-center">由星云娘 ~DevTeam~ 开发</p>
	</div>
</footer>
<script type="application/javascript">refreshExp();</script>
</body>
</html>
