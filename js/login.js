// Các kịch bản cho login.html
function checkValidLogin(fn){
	
	//Lấy thông tin đăng nhập
	var name = fn.txtUserName.value;
	var pass = fn.txtUserPass.value;
	//Khai báo biến xác nhận hợp lệ
	
	var validName = true;
	var validPass = true;
	
	//Biến thông báo lỗi
	var message = "";
	
	//Kiêm tra name
	name = name.trim();
	if(name==""){
		message = "Nhập tên tài khoản vào hệ thống!";
		validName = false;
	}else{
		if((name.length<5) || (name.length >50)){
			message= "Tên tài khoản không hợp lệ";
			validName=false;
		}else{
			if(name.indexOf("@") != -1){
				var pattern =/\w+@+\w+[.]+\w/;
				if(!name.match(pattern)){
					message ="Không đúng cấu trúc hộp thư.";
					validName=false;
				}
			}
		}
	}
	//Kiểm tra pass
	pass= pass.trim();
	if(pass==""){
		message += "\nThiếu mật khẩu vào hệ thống";
		validPass=false;
	}else{
		if(pass.length<5){
			message+= "\nMật khẩu khồng hợp lê";
			validPass=false;
		}
	}
	
	//xuấ thông báo
	if(message!=""){
		window.alert(message);
		if(!validName){
			fn.txtUserName.focus();
			fn.txtUserName.select();
		}else if(!validPass){
			fn.txtUserPass.focus();
			fn.txtUserPass.select();
		}
	}
	
	//Trả về kết quả
	return validName && validPass;
}

function login(fn){
	if(this.checkValidLogin(fn)){
		fn.method = "post"; //Chỉ định phương thức thực thi của servlet - doPost()
		fn.action= "login.php"; //Đường dẫn thực thi
		console.log("Đến đây r");
		fn.submit(); //Cơ chế gửi giữ liệu
	}
}