function bgBlur(){
	$("#bg-img").addClass("bgBlur");
}
function bgDeblur(){
	$("#bg-img").removeClass("bgBlur");
}
function toReg(){
	$("#main-form").html('<form><div class="mt-4 mb-2"><!--<label for="username" class="form-label shadow">用户名</label>--><input type="text" class="form-control " placeholder="用户名" aria-describedby="usernameHelp" id="username" onChange="check();" /><div id="usernameHelp" class="form-text"></div></div><div class="my-2"><input type="text" class="form-control " placeholder="姓名" aria-describedby="nameHelp" id="name" /><div id="nameHelp" class="form-text"></div></div><div class="my-2"><input type="tel" class="form-control " placeholder="手机" aria-describedby="phoneHelp" id="phone" onChange="check();" /><div id="phoneHelp" class="form-text"></div></div><div class="my-2"><input type="email" class="form-control " placeholder="E-Mail" aria-describedby="emailHelp" id="email" onChange="check();" /><div id="emailHelp" class="form-text"></div></div><div class="my-2"><input type="tel" class="form-control " placeholder="QQ" aria-describedby="QQHelp" id="qq" /><div id="qqHelp" class="form-text"></div></div><div class="my-2"><!--<label for="password" class="form-label shadow">密码</label>--><input type="password" class="form-control " placeholder="密码" aria-describedby="passHelp" id="password" /><div id="passHelp" class="form-text"></div></div><div class="my-2"><!--<label for="password" class="form-label shadow">密码</label>--><input type="password" class="form-control " placeholder="再次输入密码" aria-describedby="pass2Help" id="password2" /><div id="pass2Help" class="form-text"></div></div></form><div class="row m-0 p-0 justify-content-between"><button class="btn my-2 reg-btn col-4 col-lg-4" onClick="toLogin();">返回登录</button><button class="btn btn-lg my-2 btn-primary login-btn col-4 col-lg-3" onClick="reg();">注册</button></div>');
	document.title="注册 - Reimu";
}
function toLogin(){
	$("#main-form").html('<form><div class="my-4"><!--<label for="username" class="form-label shadow">用户名/手机/邮箱</label>--><input type="text" class="form-control form-control-lg" placeholder="用户名/手机/邮箱" aria-describedby="usernameHelp" id="username" /><div id="usernameHelp" class="form-text"></div></div><div class="my-4"><!--<label for="password" class="form-label shadow">密码</label>--><input type="password" class="form-control form-control-lg" placeholder="密码" aria-describedby="passHelp" id="password" /><div id="passHelp" class="form-text"></div></div></form><div class="row m-0 p-0 justify-content-between"><button class="btn btn-lg my-2 reg-btn col-4 col-lg-3" onClick="toReg();">注册</button><button class="btn btn-lg my-2 btn-primary login-btn col-4 col-lg-3" onClick="login();">登录</button></div>');
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
			$("#emailHelp").html('<p class="text-danger">用E-mail已存在</p>');
			alert("E-mail已存在");
		}else{
			$("#emailHelp").html('');
		}
	});
}