// Các cấu trúc xử lý cho user.html

// Sinh cấu trúc permission
function generatePermis(){
	var permis= new Array();
	permis[0]="---chọn---";
	permis[1]="Thành viên (members) ";
	permis[2]="Tác giả (author)";
	permis[3]="Quản lý (mangers)";
	permis[4]="Quản trị (administrator)";
	permis[5]="Quản trị cấp cao (supers)";
	
	var permis2 = new Array("---chọn---","Thành viên",permis[2],"","","");
	var permis3 = ["---chọn---","Thành viên",permis[2],"","",""];
	
	var opt="<select name=\"\" class=\"form-control\" id=\"chkPermis\" onchange=\"refreshPermis(this.form)\" >";
	for(var i=0; i<permis.length; i++){
		opt+="<option value=\""+i+"\">";
		opt+=permis[i];
		opt+="</option>";
	}
	opt+="</select>";
	
	//Xuất cấu trúc
	document.write(opt);	
}
// ForEach
function generatePermis2(){
	var permis= new Array();
	permis[0]="---chọn---";
	permis[1]="Thành viên (members) ";
	permis[2]="Tác giả (author)";
	permis[3]="Quản lý (mangers)";
	permis[4]="Quản trị (administrator)";
	permis[5]="Quản trị cấp cao (supers)";
	
	permis.forEach(viewOption);
}
function viewOption(element,index,array){
	document.write("<option value=\""+index+"\">"+element+"</option>");
}

//-------------------------------------------

function generateRoles(){
	// Danh sachs vai tro
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
	// Duyệt mảng vai trò tạo cấu trúc
	var role="";
	for(var i=0; i< roles.length;i++){
		if(i%3 == 0) {
			role+="<div class=\"row\">";
		}
		
		role+=viewRole(i,roles[i]);
		
		if((i%3 ==2) || (i==roles.length-1)){
			role +="</div>";
		}
	}
	document.write(role);
}
function viewRole(id,name){
	var role = "";
	role +="<div class=\"col-md-4\">";
	role +="<div class=\"from-check\">";
	role +="<input type=\"checkbox\" disabled name=\"chks\" class=\"form-check-input\" id=\"chk"+id+"\" onclick=\"checkPermis(this.form)\">";
	role +="<label for=\"chk"+id+"\" class=\"form-check-label\">Quản lý "+name+"</label>";
	role +="</div>";
	role +="</div>";
	return role;
}

//------------------------------------------------------
function setCheckBox(fn, dis, check){
	// duyệt các phần tử của form và tìm ra các check box cần làm viêc
	for(var i=0 ; i< fn.elements.length; i++){
		if((fn.elements[i].type == "checkbox") && (fn.elements[i].name == "chks")){
			
			fn.elements[i].disabled = dis;
			fn.elements[i].checked = check;
		}
	}
}
function refreshPermis(fn){
	//Lấy giá trị permistion 
	var permis = parseInt(document.getElementById("chkPermis").value);
	if((permis == 4) || (permis==5)){
		this.setCheckBox(fn,true,true);
	}else if(permis==3){
		this.setCheckBox(fn,false,true);
		//Ngầm định cho quản lý có vai trò quản lý người sử dụng
		var first_role= document.getElementById("chk0");
		first_role.disabled=true;
	}else if(permis==2){
		this.setCheckBox(fn,false,false);
	}else{
		this.setCheckBox(fn,true,false);
	}
	this.checkPermis(fn);
}
//------------------------------------------------------




//-------------------------------------------
function checkName(fn){
	var name= document.getElementById('txtName').value;
	var validName=true;
	name= name.trim();
	var message="";
	
	//Tham chiếu vào hộp nhập emai;
	var email = document.getElementById("txtEmail");
	if(name ==""){
		message="Thiếu tên tài khoản!";
		validName=false
	}else{
		if(name.indexOf(" ") !=-1){
			message= "Tên không được chứa dấu cách";
			validName=false;
		}else {
			if((name.length<5) ||(name.length >50)){
			message="Ten tài khoản cần có độ dài từ 5 đến 50 kí tự!";
			validName=false;
			}else{
				if(name.indexOf('@') !=-1){
					var pattern = /\w+@+\w+[.]+\w/;
					if(!name.match(pattern)){
						message="Không đúng cấu trúc hộp thư !";
						validName= false;
						email.disabled=false;
					}else{
						email.disabled = true;
					}
				}else{
					email.disabled=false;
				}
			}
		}
	}
	//Tham chiếu vào đối tượng báo lỗi
	var viewErr= document.getElementById("errName");
	if(validName){
		viewErr.innerHTML="<i class=\"fas fa-check-circle\"></i>";
		viewErr.style.color = "green";
		viewErr.style.fontWeight = 600;
		viewErr.style.marginTop=5;
	}else{
		viewErr.innerHTML=message;
		viewErr.style.color = "red";
		viewErr.style.fontWeight = 600;
		viewErr.style.marginTop=5;
	}
	return validName;
}


//-------------------------------------------
/*function checkPass(){
	var pass= document.getElementById("txtPass").value;
	var validPass=true;
	var message="";
	pass= pass.trim();
	if(pass==""){
		message="Mật khẩu không được để trống!";
		validPass=false;
	}else{
		if(pass.length<8){
			message="Mật khẩu quá ngắn!";
			validPass=false
		}else if(pass.length>50){
			message="Mật khẩu quá dài!";
			validPass=false;
		}
	}
	var viewErr= document.getElementById("errPass");
	if(validPass){
		viewErr.innerHTML = "<i class=\"fas fa-check-circle\"></i>";
		viewErr.style.color="green";
		viewErr.style.fontWeight = 600;
		viewErr.style.marginTop=5;
	}else{
		viewErr.innerHTML = message;
		viewErr.style.color="red";
		viewErr.style.fontWeight = 600;
		viewErr.style.marginTop=5;
	}
	return validPass;
}
//-------------------------------------------
function checkPass2(){
	var pass=document.getElementById("txtPass").value.trim();
	var pass2 = document.getElementById("txtPass2").value.trim();
	var viewErr= document.getElementById("errPass2");
	var validPass2=true;
	if(pass2 !=""){
		if(pass!=pass2){
			viewErr.innerHTML = "<i class=\"fas fa-times\"></i>";
			viewErr.style.color="red";
			viewErr.style.fontWeight = 600;
			viewErr.style.marginTop=5;
		}else{
			viewErr.innerHTML = "<i class=\"fas fa-check-circle\"></i>";
			viewErr.style.color="green";
			viewErr.style.fontWeight = 600;
			viewErr.style.marginTop=5;
		}
	}else{
		viewErr.innerHTML = "Không được để trống!";
		viewErr.style.color="red";
		viewErr.style.fontWeight = 600;
		viewErr.style.marginTop=5;
	}
}
//-------------------------------------------
function checkPermis(fn){
	var permis= document.getElementById("chkPermis").value;
	var validPermis=true;
	var viewErr=document.getElementById("errPermis");
	var countCheck=0;
	for(var i=0; i< fn.elements.length; i++ ){
		if(fn.elements[i].type=="checkbox"){
			if(fn.elements[i].checked){
				countCheck++;
			}
		}
	}
	console.log(countCheck);
	if((permis==2) || (permis==3)){
		if(countCheck==0){
			validPermis=false;
			viewErr.innerHTML = "Không được để trống!";
			viewErr.style.color="red";
			viewErr.style.fontWeight = 600;
			viewErr.style.marginTop=5;
		}else{
		viewErr.innerHTML ="";
		}
	}
	return validPermis;
}*/
//-------------------------------------------
function checkPass(){
	var pass= document.getElementById("txtPass").value.trim();
	var pass2= document.getElementById("txtPass2").value.trim();
	var name = document.getElementById("txtName").value.trim();
	var validPass= true;
	var validPass2= true;
	var message="";
	if(pass==""){
		message="Thiếu mật khẩu cho tài khoản!";
		validPass=false;
	}else{
		if((pass.length>=6) && (pass.length<=50)){
			if(pass.indexOf(name)!=-1){
				message="Mật khẩu không chứa tên đăng nhập";
				validPass=false;
			}else{
				
				if(pass2==""){
					message = "Mật khẩu xác nhận lại không có";
					validPass2=false;
				}else{
					if(pass!=pass2){
						message="Mật khẩu xác nhận không  khớp";
						validPass2=false;
					}
				}
			}
		}else{
			message="Mật khẩu quá ngắn hoặc quá dài [6->50]";
			validPass= false;
		}
	}
	// Tham chiếu các đối tượng báo lỗi
	var errPass = document.getElementById("errPass");
	var errPass2 = document.getElementById("errPass2");
	
	if(validPass && validPass2){
		errPass.innerHTML = "<i class=\"fas fa-check-circle\"></i>";
		errPass.style.color="green";
		errPass.style.fontWeight = 600;
		errPass.style.marginTop=5;
		errPass2.innerHTML = "";
	}else{
		if(!validPass){
			errPass.innerHTML = message;
			errPass.style.color="red";
			errPass.style.fontWeight = 600;
		}else{
			errPass.innerHTML="";
		}
		
		if(!validPass2){
			errPass2.innerHTML = message;
			errPass2.style.color="red";
			errPass2.style.fontWeight = 600;
		}
	}
	return validPass && validPass2;
	
}
//-------------------------------------------
function checkEmail(){
	//Tham chiếu đến Email
	var email= document.getElementById("txtEmail").value;
	var validEmail = true;
	
	var message="";
	if(email==""){
		message="Thiếu hộp thư cho tài khoản";
		validEmail=false;
	}else{
		if(email.indexOf("@")==-1){
			message="Không phải cấu trúc hộp thư";
			validEmail=false;
		}else{
			var pattern=/\w+@\w+[.]+\w/;
			if(!email.match(pattern)){
				message="Không đúng cấu trúc hộp thư";
				validEmail=false;
			}
		}
	}
	//Tham chiếu đến đối tượng thông báo lỗi
	var errEmail= document.getElementById("errEmail");
	if(!validEmail){
		errEmail.innerHTML = message;
		errEmail.style.color="red";
		errEmail.style.fontWeight = 600;
	}else{
		errEmail.innerHTML="";
	}
	return validEmail;
}
//-------------------------------------------
function checkPermis(fn){
	var permis= parseInt(document.getElementById("chkPermis").value);
	
	var validPermis= true;
	
	var message="";
	
	if((permis==2) || (permis==3)){
		for(var i=0; i<fn.elements.length ; i++){
			if(fn.elements[i].type=="checkbox" && fn.elements[i].name=="chks"){
				if(fn.elements[i].checked){
					if(fn.elements[i].disabled){
						message="Bạn có muốn thêm vai trò?";
					}else{
						message="";
						validPermis=true;
						break;
					}
					
				}else{
					if(permis != 3){
					message ="Cần phải có ít nhất một vai trò cho quyền này"; 
					validPermis=false;}
				}
			}
		}
	}
	
	// Tham chiếu báo lỗi
	var errPermis= document.getElementById("errPermis");
	if(!validPermis){
		errPermis.innerHTML= message;
		errPermis.style.color="red";
		errPermis.style.fontWeight = 600;
	}else{
		errPermis.innerHTML=message;
		errPermis.style.color="blue";
		errPermis.style.fontWeight = 600;
	}
	return validPermis;
}
//-------------------------------------------
function checkValidUser(fn){
	//Kiểm tra name
	var validName=checkName(fn);
	
	//Kiểm tra pass
	var validPass=checkPass();
	
	var validEmail= checkEmail();
	
	var validPermis= checkPermis(fn);
	
	if(!validName){
		document.getElementById("txtName").focus();
		document.getElementById("txtName").select();
	}else if(!validPass){
		document.getElementById("txtPass").focus();
		document.getElementById("txtPass").select();
	} else if(!validEmail){
		document.getElementById("txtEmail").focus();
		document.getElementById("txtEmail").select();
	}else if(!validPermis){
		document.getElementById("chkPermis").focus();
		document.getElementById("chkPermis").select();
	}
	return validEmail && validName && validPass && validPermis;
}









