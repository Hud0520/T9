//Sinh cấu trúc permission

function generatePermis(){
	var permis=[
	"-----Chọn-----",
	"Thành viên (members)",
	"Tác giả (author)",
	"Quản lý (managers)",
	"Quản trị (administrator)",
	"Quản trị cao cấp (supers)"
	];
	
	$("#permis").append("<select name=\"\" class=\"form-control\" id=\"chkPermis\" onchange=\"refreshPermis(this.form)\"></select>");
	for(var i=0; i<permis.length; i++){
		var opt="<option value=\""+i+"\">"+permis[i]+"</option>";
		$("#chkPermis").append(opt);
		
	}
	
};

$(document).ready(generatePermis());

// Sinh roles
$(window).ready(function(){
	var roles = new Array(
		"Người sử dụng",
		"Chuyên mục",
		"Thể loại",
		"Bài viết && Tin tức",
		"Hệ sản phẩm",
		"Nhóm sản phẩm",
		"Loại sản phẩm",
		"Sản phẩm",
		"Hóa đơn",
		"Khách hàng"
	);
	$("#roles").append("<div class=\"row\">");
	for(var i=0; i<roles.length; i++){
		$('#roles .row').append(viewRole(i,roles[i]));
	}
})
function viewRole(id,name){
	var role = "<div class=\"col-md-4\">";
	role+="<div class=\"form-check\">";
	role+="<input type=\"checkbox\" disabled name=\"chks\" class=\"form-check-input\" id=\"chk"+id+"\" onclick=\"checkPermisjq(this.form)\">";
	role+="<label for=\"chk"+id+"\" class=\"form-check-label\">Quản lý "+name+"</label>";
	role+="</div>";
	role+="</div>";
	return role;
}
//----------------------------------
function setCheckBox(fn,dis,check){
	for(var i=0; i< fn.elements.length; i++){
		if((fn.elements[i].type== "checkbox")&&(fn.elements[i].name=="chks")){
			fn.elements[i].disabled = dis;
			fn.elements[i].checked = check;
		}
	}
}

function refreshPermis(fn){
	var permis= parseInt($("#chkPermis").val());
	if((permis == 4) || (permis == 5)){
		this.setCheckBox(fn,true,true);
	}else if(permis == 3){
		this.setCheckBox(fn,false,true);
		$("#chk0").attr('disabled','true');
	}else if(permis == 2){
		this.setCheckBox(fn,false,false);
	}else{
		this.setCheckBox(fn,true, false);
	}
	this.checkPermisjq(fn);
}
//--------------------------
function checkNamejq(){
	var name = $("#txtName").val();
	var validName= true;
	var message="";

	var email = $("#txtEmail");
	if(name.trim() == ""){
		message ="Thiếu tên tài khoản !";
		validName= false;
	}else{
		if(name.indexOf(' ') !=-1){
			message= "Tên không được chứa khoảng trắng!";
			validName= false;
		}else{
			if((name.length<5)||(name.length>50)){
				message="Tền tài khoản nên có độ dài từ 5 đến 50 kí tự";
				validName= false;
			}else{
				if(name.indexOf('@') !=-1){
					var pattern = /\w+@\w+[.]+\w/;
					if(!name.match(pattern)){
						message="Không đúng cấu trúc hộp thư";
						validName = false;
						email.attr('disabled',false);
					}else{
						email.attr('disabled',true);
					}
				}else{
					email.attr('disabled',false);
				}
			}
		}
	}
	if(validName){
		$('#errName').html("<i class=\"fas fa-check-circle\"></i>");
		$('#errName').css({'color':'green',
						   'fontWeight':'600',
						   'marginTop':5});
	}else{
		$('#errName').text(message);
		$('#errName').css({'color':'red',
						   'fontWeight':'600',
						   'marginTop':5});
	}
	return validName;
}

function checkPassjq(){
	var pass = $("#txtPass").val().trim();
	var pass2 = $("#txtPass2").val().trim();
	var name = $("#txtName").val().trim();
	var validPass= true;
	var validPass2= true;
	var message="";

	if(pass==""){
		message= "Mật khẩu không được để trống!";
		validPass=false;
	}else{
		if((pass.length>=6)&&(pass.length<=50)){
			if(pass.indexOf(name)!=-1){
				message="Mật khẩu không nên chứa tên đăng nhập";
				validPass= false;
			}else{
				if(pass2 == ""){
					message="Mật khẩu xác nhận không có";
					validPass2= false;
				}else{
					if(pass != pass2){
						message="Mật khẩu xác nhận không khớp";
						validPass2=false;
					}
				}
			}
		}else{
			message="Mật khẩu qua ngắn hoặc quá dài";
			validPass=false;
		}
	}

	if(validPass && validPass2){
		$('#errPass').html("<i class=\"fas fa-check-circle\"></i>");
		$('#errPass').css({
			'color':'green',
			'fontWeight':'400',
			'marginTop':'5'
		})
		$('#errPass2').html("");
	}else{
		if(!validPass){
			$('#errPass').html(message);
			$('#errPass').css({
				'color':'red',
				'fontWeight':'600'
			});
		}else{
			$("#errPass").html("");
		}

		if(!validPass2){
			$('#errPass2').html(message);
			$('#errPass2').css({
				'color':'red',
				'fontWeight':'600'
			});
		}
	}
	return validPass&&validPass2;
}

function checkEmailjq(){
	var email= $('#txtEmail').val();
	var validEmail=true;
	var message="";

	if(email == ""){
		message="Thiếu hộp thư cho tài khoản";
		validEmail=false;
	}else{
		var pattern = /\w+@+\w+[.]+\w/;
		if(!email.match(pattern)){
			message="Không đúng cấu trúc hộp thư";
			validEmail= false;
		}
	}

	if(!validEmail){
		$('#errEmail').html(message);
		$('#errEmail').css({
			'color':'red',
			'fontWeight':'600'
		});
	}else{
		$('#errEmail').html("");
	}
	return validEmail;
}

//--------------------------------------
function checkPermisjq(fn){
	var permis = parseInt($('#chkPermis').val());
	var validPermis = true;
	var message= "";
	console.log(permis,typeof(permis));
	if((permis==2)||(permis==3)){
		var checkboxs = $('#roles :checkbox');
		for(var i=0 ; i<checkboxs.length; i++){
			if(checkboxs[i].checked){
				if(checkboxs[i].disabled){
					message="Bạn có muốn thêm vai trò";
				}else{
					message= "";
					validPermis= true;
					break;
				}
			}else{
				if(permis != 3){
					message = "Cần phải có ít nhất một vai trò cho quyền này";
					validPermis=false
				}
			}
		}
	}
	console.log(message);
	//Thông báo lỗi
	var errPm = $("#errPermis");
	if(!validPermis){
		errPm.text(message);
		errPm.css({'color':'red','fontWeight':'600'});
	}else{
		errPm.text(message);
		errPm.css({'color':'green', 'fontWeight':'600'});
	}
	return validPermis;
}
function checkValidUserjq(){
	var validName=checkNamejq();
	var validPass=checkPassjq();
	var validEmail= checkEmailjq();
	var validPermis = checkPermisjq();

	if(!validName){
		$('#txtName').focus().select();
	}else if(!validPass){
		$('#txtPass').focus().select();
	}else if(!validEmail){
		$('#txtEmail').focus().select();
	}else if(!validPermis){
		$('#chkPermis').focus().select();
	}
	return validName && validEmail && validPass && validPermis;
}