<!doctype html>
<?php
session_start();
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . "includes/user.class.php" );
if ( isset( $_GET[ "uid" ] ) ) {
	$uid = intval( $_GET[ "uid" ] );
} else {
	//$uid = 1;
	http_response_code(404);
}
$user = new User();
$user->updateObj( uid: $uid );
$display=$user->GetInfo();
if($user->introduction==""){
	$user->introduction='<i class="bi bi-x-circle-fill"></i>'."蚌埠住了，".$user->name."比孙笑川还懒，什么也没有写。";
}
if(!$display){
	header("Location: /404.html");
}
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
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
<title><?php echo($user->name); ?> - Reimu模联名片</title>
<link href="/css/bootstrap.min.css" rel="stylesheet" />
<link href="/css/space.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<script type="application/javascript" src="/js/bootstrap.bundle.min.js"></script> 
<script type="application/javascript" src="/js/jquery-3.6.0.min.js"></script>
<script type="application/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<script type="application/javascript" src="/js/space.js"></script>
<script type="application/javascript">
	if(is_weixn()&&window.location.href.includes("xn--")){
        window.location.href=window.location.href.replace("xn--5nx.xn--9kq078c8zcrt4a.xn--fiqs8s","reimu.nbmun.cn");
	}
	var timestamp=<?php echo time(); ?>;
	var randstr=getRandomString(8);
	var url=window.location.href;
	var ticket="";
	var signature="";
	$.post("/includes/query.php",{
		f:"wt"
	},function(data){
		ticket=data;
        $.post("/includes/query.php",{
            f:"ws",
            timestamp:timestamp,
            randstr:randstr,
            url:url,
            ticket:ticket
        },function(data){
            signature=data;
            wx.config({
                debug: false,
                appId: '<?php echo(WECHAT_APPID); ?>',
                timestamp: timestamp, // 必填，生成签名的时间戳
                nonceStr: randstr, // 必填，生成签名的随机串s
                signature: signature,// 必填，签名
                jsApiList: ["updateAppMessageShareData","updateTimelineShareData"] // 必填，需要使用的JS接口列表
            });
            wx.ready(function(){
                wx.updateAppMessageShareData({
                    title: '<?php echo($user->name); ?> - Reimu模联名片', // 分享标题
                    desc: '<?php echo($user->sign); ?>', // 分享描述
                    link: url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: 'https://'+document.domain+'/storage/avatar/<?php echo($avatar); ?>', // 分享图标
                    success: function () {

                    }
                });
                wx.updateTimelineShareData({
                    title: '<?php echo($user->name); ?> - Reimu模联名片', // 分享标题
                    link: url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: 'https://'+document.domain+'/storage/avatar/<?php echo($avatar); ?>', // 分享图标
                    success: function () {

                    }
                });
            });
        });
	});

</script>
</head>

<body>
<?php
if(isset($_SESSION["uid"])){
	if($_SESSION["uid"]==$uid){
		echo('<nav class="navbar navbar-expand-lg navbar-light bg-light shadow mb-3" role="navigation">
	<div class="container-fluid"> <a class="navbar-brand" href="/"><img class="logo" src="/storage/reimu/logo.svg" /></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<u1 class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="/">主面板</a></li>
				<li class="nav-item"><a class="nav-link" href="#">表白墙</a></li>
				<li class="nav-item dropdown"> <a href="/" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> 我的资料 <b class="caret"></b> </a>
					<ul class="dropdown-menu">
						<li><a  class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">退出登录</a></li>
					</ul>
				</li>
			</u1>
		</div>
	</div>
</nav>');
	}
}
?>
<main>
	<div class="container-fluid p-0">
		<div class="row justify-content-center">
			<div class="card border-0 col-12 col-md-10 col-lg-9 shadow-cus p-0" onMouseOver="addNb();" onMouseOut="delNb();">
				<img id="bgimg" class="card-img-top bgimg rounded" src="/storage/bg/<?php echo($bg); ?>" alt="Card image"/>
				<div class="px-5 py-3 card-body text-white rounded card-img-overlay">
					<div class="row"> <img class="rounded-circle p-0 col-3 img-shadow" style="height:96px;width:96px;" src="/storage/avatar/<?php echo($avatar); ?>">
						<div class="col-6 py-2">
							<h4 id="name" class="ps-4 text-shadow"><?php echo($user->name); ?> (<?php echo($user->username); ?>)</h4>
							<?php
							if($user->sex==1){
								echo('<i class="bi bi-gender-male ps-4"></i>');
							}elseif($user->sex==2){
								echo('<i class="bi bi-gender-female ps-4"></i>');
							}elseif($user->sex==3){
								echo('<p class="ps-4">性别：魂魄妖梦！</p>');
							}
							?> 
						</div>
					</div>
					<hr class="my-2">
					<p class=" text-shadow"><?php echo($user->school); ?></p>
					<hr class="my-2">
					<div class="row">
					<p class="text-shadow col-9"><?php echo($user->sign); ?></p>
					<img id="qr" class="float-end col-3 qr" />
					</div>
				</div>
			</div>
			<div class="col-12 col-md-10 col-lg-9" id="infoContainer">
				<h4 class="py-2 mt-4 mx-2">个人简介</h4>
				<hr class="my-2 mx-2" />
				<p class="py-2 mx-2"><?php echo(str_replace("\n","<br />",$user->introduction)); ?></p>
				<h4 class="py-2 mt-4 mx-2">联系方式</h4>
				<hr class="my-2 mx-2" />
				<p class="py-2 mx-2">
					<?php
					if($display["phone"]==1){
						echo('<i class="bi bi-phone-fill"></i>'."手机：".$user->phone."<br />");
					}
					if($display["email"]==1){
						echo('<i class="bi bi-envelope-fill"></i>'."邮箱：".$user->email."<br />");
					}
					if($display["qq"]==1){
						echo('<svg class="icon" style="width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="505"><path d="M824.8 613.2c-16-51.4-34.4-94.6-62.7-165.3C766.5 262.2 689.3 112 511.5 112 331.7 112 256.2 265.2 261 447.9c-28.4 70.8-46.7 113.7-62.7 165.3-34 109.5-23 154.8-14.6 155.8 18 2.2 70.1-82.4 70.1-82.4 0 49 25.2 112.9 79.8 159-26.4 8.1-85.7 29.9-71.6 53.8 11.4 19.3 196.2 12.3 249.5 6.3 53.3 6 238.1 13 249.5-6.3 14.1-23.8-45.3-45.7-71.6-53.8 54.6-46.2 79.8-110.1 79.8-159 0 0 52.1 84.6 70.1 82.4 8.5-1.1 19.5-46.4-14.5-155.8z" p-id="506"></path></svg>'."QQ：".$user->qq."<br />");
					}
					if($display["wechat"]==1){
						echo('<i class="bi bi-chat-right-dots-fill"></i>'."微信：".$user->wechat."<br />");
					}
					if($display["phone"]==0&&$display["email"]==0&&$display["qq"]==0&&$display["wechat"]==0){
						echo('<i class="bi bi-x-circle-fill"></i>'.$user->name."没有提供任何联系方式……"."<br />");
					}
					?>
				</p>
				<h4 class="py-2 mt-4 mx-2">参会经历</h4>
				<hr class="my-2 mx-2" />
				<div class="py-2 mx-2">
					<?php
					$exp=$user->GetExperience();
					if($exp!=0&&$display["experience"]==1){
						echo('<div class="accordion" id="exp">');
						foreach($exp as $e){
							if($e["committee"]!=""){
								$e["committee"]="委员会：".$e["committee"]."<br />";
							}
							if($e["topic"]!=""){
								$e["topic"]=$e["topic"]."<br />";
							}
							$output='<div class="accordion-item">
							<h2 class="accordion-header" id="expHead'.$e["id"].'">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#exp'.$e["id"].'" aria-expanded="false" aria-controls="exp'.$e["id"].'">
							'.$e["name"].'
							</button>
							</h2>
							<div id="exp'.$e["id"].'" class="accordion-collapse collapse" aria-labelledby="expHead'.$e["id"].'">
							<div class="accordion-body">
							<strong>'.$e["committee"].'</strong>'.$e["topic"].$e["seat"].'<br />'.$e["title"].'
							</div>
							</div>
							</div>';
							echo($output);
						}
						unset($e);
						echo("</div>");
					}else{
						echo('<i class="bi bi-x-circle-fill"></i>'.$user->name."暂未公开参会经历……");
					}
					?>
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
<footer class="mt-5" style="bottom: 0; width: 100%">
	<p class="text-center"><a href="/login">获取我的模联名片</a></p>
	<div class="container-fluid bg-dark text-white" style="height: 108px;z-index:-999">
		<h5 class="px-auto text-center">灵Reimu 模联名片</h5>
		<p class="text-center">由星云娘 ~DevTeam~ 开发<br/><a href="https://beian.miit.gov.cn">京ICP备2022009339号-3</a><br/><a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010802039245"><img src="https://nbmun.cn/wp-content/uploads/2022/04/2022-04-14_23-12-54_472354.png">京公网安备 11010802039245号</a></p>
	</div>
</footer>
	<script type="application/javascript">$("#qr").attr("src","https://api.qrserver.com/v1/create-qr-code/?data="+window.location.href+"&size=512x512");</script>
</body>
</html>