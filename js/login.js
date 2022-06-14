function bgBlur(){
	$("#bg-img").addClass("bgBlur");
}
function bgDeblur(){
	$("#bg-img").removeClass("bgBlur");
}
function toReg(){
	$("#main-form").html('<form><div class="mt-4 mb-2"><!--<label for="username" class="form-label shadow">用户名</label>--><input type="text" class="form-control " placeholder="用户名（不可包含单双引号,&,<,>）" aria-describedby="usernameHelp" id="username" onChange="check();" /><div id="usernameHelp" class="form-text"></div></div><div class="my-2"><input type="text" class="form-control " placeholder="真实姓名" aria-describedby="nameHelp" id="name" /><div id="nameHelp" class="form-text"></div></div><div class="my-2"><input type="tel" class="form-control " placeholder="手机" aria-describedby="phoneHelp" id="phone" onChange="check();" /><div id="phoneHelp" class="form-text"></div></div><div class="my-2"><input type="email" class="form-control " placeholder="E-Mail" aria-describedby="emailHelp" id="email" onChange="check();" /><div id="emailHelp" class="form-text"></div></div><div class="my-2"><input type="tel" class="form-control " placeholder="QQ" aria-describedby="QQHelp" id="qq" /><div id="qqHelp" class="form-text"></div></div><div class="my-2"><!--<label for="password" class="form-label shadow">密码</label>--><input type="password" class="form-control " placeholder="密码" aria-describedby="passHelp" id="password" /><div id="passHelp" class="form-text"></div></div><div class="my-2"><!--<label for="password" class="form-label shadow">密码</label>--><input type="password" class="form-control " placeholder="再次输入密码" aria-describedby="pass2Help" id="password2" /><div id="pass2Help" class="form-text"></div></div></form><div class="row m-0 p-0 justify-content-between"><button class="btn my-2 reg-btn col-4 col-lg-4" onClick="toLogin();">返回登录</button><button class="btn btn-lg my-2 btn-primary login-btn col-4 col-lg-3" id="TencentCaptcha" data-appid="'+TC_APPID+'" data-cbfn="capCallback" data-biz-state="data-biz-state">注册</button></div>');
	document.title="注册 - Reimu";
	new TencentCaptcha(document.getElementById('TencentCaptcha'));
}
function toLogin(){
	$("#main-form").html('<form><div class="my-4"><!--<label for="username" class="form-label shadow">用户名/手机/邮箱</label>--><input type="text" class="form-control form-control-lg" placeholder="用户名/手机/邮箱" aria-describedby="usernameHelp" id="username" /><div id="usernameHelp" class="form-text"></div></div><div class="my-4"><!--<label for="password" class="form-label shadow">密码</label>--><input type="password" class="form-control form-control-lg" placeholder="密码" aria-describedby="passHelp" id="password" /><div id="passHelp" class="form-text"></div></div></form><div class="row mb-1 justify-content-end"><a href="https://wpa.qq.com/msgrd?v=3&uin=1848790911&site=qq&menu=yes" class="col-4 text-end">忘记密码</a></div> <div class="row m-0 p-0 justify-content-between"><button class="btn btn-lg my-2 reg-btn col-4 col-lg-3" onClick="toReg();">注册</button><button class="btn btn-lg my-2 btn-primary login-btn col-4 col-lg-3" onClick="login();">登录</button></div>');
	document.title="登录 - Reimu";
}
function check(){
	var username=$("#username").val();
	var phone=$("#phone").val();
	var email=$("#email").val();
	$.post("/includes/query.php",{
		f:"Check",
		username:username,
		phone:phone,
		email:email,
		identity:""
	},function(data,status){
		if(data.includes("username")){
			$("#usernameHelp").html('<p class="text-danger">用户名已存在</p>');
			alert("用户名已存在");
		}else{
			$("#usernameHelp").html('');
		}
		if(data.includes("phone")){
			$("#phoneHelp").html('<p class="text-danger">手机号已存在</p>');
			alert("手机号已存在");
		}else{
			$("#phoneHelp").html('');
		}
		if(data.includes("email")){
			$("#emailHelp").html('<p class="text-danger">E-mail已存在</p>');
			alert("E-mail已存在");
		}else{
			$("#emailHelp").html('');
		}
	});
	
}
function checkPass(){
	var pass1=$("#password").val();
	var pass2=$("#password2").val();
	if(pass1!=pass2){
		$("#pass2Help").html('<p class="text-danger">两次输入密码不符</p>');
	}
}
window.capCallback=function(res){
	if(res.ret===0){
		var username=$("#username").val();
		var name=$("#name").val();
		var phone=parseInt($("#phone").val());
		var email=$("#email").val();
		var qq=parseInt($("#qq").val());
		var password=$("#password").val();
		if(username==""||name==""||phone==null||email==""||qq==null||password==""){
			alert("输入不完整");
			return false;
		}
		$.post("/includes/query.php",{
			f:"Reg",
			Ticket:res.ticket,
			Randstr:res.randstr,
			username:username,
			name:name,
			phone:phone,
			email:email,
			qq:qq,
			password:password
		},function(data,status){
			if(data=="1"){
			$("#up-notice").html('<div class="alert alert-success" role="alert"><i class="bi bi-check-circle-fill"></i>注册成功，返回登录</div>');
			setTimeout("window.location='/login'",2000);
			}else if(data=="孙笑川"){
				$("#up-notice").html('<div class="alert alert-danger" role="alert" id="log-fail"><i class="bi bi-x-circle-fill"></i>注册失败,验证错误</div>');
				setTimeout("logFailDisappear()",2000);
			}else if(data=="2"){
				$("#up-notice").html('<div class="alert alert-danger" role="alert" id="log-fail"><i class="bi bi-x-circle-fill"></i>注册失败,同一IP每天最多注册一次</div>');
				setTimeout("logFailDisappear()",2000);
			}else{
				$("#up-notice").html('<div class="alert alert-danger" role="alert" id="log-fail"><i class="bi bi-x-circle-fill"></i>注册失败,数据错误</div>');
				setTimeout("logFailDisappear()",2000);
			}
		});
	}
}
function logFailDisappear(){
	$("#log-fail").slideUp(1000);
}
function login(){
	var login=$("#username").val();
	var password=$("#password").val();
	$.post("/includes/query.php",{
		f:"Login",
		login:login,
		password:password
	},function(data,status){
		if(data=="1"){
			$("#up-notice").html('<div class="alert alert-success" role="alert"><i class="bi bi-check-circle-fill"></i>登录成功</div>');
			if(oauth){
				$.post("/includes/query.php",{
					f:"oauth_code"
				},function(data){
					if(data!=""){
						window.location.href=redirect+"?code="+data;
					}
				});
			}
			setTimeout("window.location='/'",2000);
		}else if(data=="0"){
			$("#up-notice").html('<div class="alert alert-danger" role="alert" id="log-fail"><i class="bi bi-x-circle-fill"></i>登录失败</div>');
			setTimeout("logFailDisappear()",2000);
		}
	})
}