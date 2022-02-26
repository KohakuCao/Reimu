function Logout(){
	$.post("/includes/query.php",{"f":"Logout"},function(data){
		if(data=="1"){
			window.location="/";
		}
	});
}
function check(){
	var username=$("#username").val();
	var phone=$("#phone").val();
	var email=$("#email").val();
	var identity=$("#identity").val();
	$.post("/includes/query.php",{
		f:"Check",
		username:username,
		phone:phone,
		email:email,
		identity:identity
	},function(data,status){
		if(data.includes("phone")){
			$("#phoneHelp").html('<p class="text-danger">手机号已存在</p>');
		}else{
			$("#phoneHelp").html('');
		}
		if(data.includes("email")){
			$("#emailHelp").html('<p class="text-danger">E-mail已存在</p>');
		}else{
			$("#emailHelp").html('');
		}
		if(data.includes("identity")){
			$("#identityHelp").html('<p class="text-danger">身份证号已存在</p>');
		}else{
			$("#identityHelp").html('');
		}
	});
	
}
function updateInfo(){
	var identity=$("#identity").val();
	var sex=parseInt($("#sex").val());
	var school=$("#school").val();
	var phone=parseInt($("#phone").val());
	var email=$("#email").val();
	var qq=parseInt($("#qq").val());
	var introduction=$("#introduction").val();
	var sign=$("#sign").val();
	if($("#email_display").is(":checked")){
		var email_display=1;
	}else{
		var email_display=0;
	}
	if($("#phone_display").is(":checked")){
		var phone_display=1;
	}else{
		var phone_display=0;
	}
	if($("#email_display").is(":checked")){
		var qq_display=1;
	}else{
		var qq_display=0;
	}
	$.post("/includes/query.php",{
		f:"UpdateInfo",
		identity:identity,
		sex:sex,
		email:email,
		phone:phone,
		qq:qq,
		school:school,
		introduction:introduction,
		sign:sign,
		email_display:email_display,
		qq_display:qq_display,
		phone_display:phone_display
	},function(data){
		if(data=="1"){
			var toastId=$("#updateSucToast");
			var toast=new bootstrap.Toast(toastId);
			toast.show();
			setTimeout("window.location='/'",2000);
		}else if(data=="0"){
			alert("数据库错误!");
			setTimeout("$('#update-fail').slideUp(1000);",2000);
		}else{
			alert("接口错误！");
		}
	});
}