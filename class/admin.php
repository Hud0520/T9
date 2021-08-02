<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/session.php');
	Session::checkLogin(); // gọi hàm check login để ktra session
	include_once($filepath.'/../lib/database.php');
?>



<?php 
	/**
	* 
	*/
	class admin
	{
		private $db;
		public function __construct()
		{
			$this->db = new Database();
		}
		public function longin_admin($adminUser,$adminPass){

			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass); //mysqli gọi 2 biến. (adminUser and link) biến link -> gọi conect db từ file db
			
				$query = "SELECT * FROM admin WHERE TaiKhoan = '$adminUser' AND MatKhau = '$adminPass' LIMIT 1 ";
				$result = $this->db->select($query);

				if($result != false){
					//session_start();
					// $_SESSION['login'] = 1;
					//$_SESSION['user'] = $user;
					$value = $result->fetch_assoc();
					Session::set('adminlogin', true); // set adminlogin đã tồn tại
					// gọi function Checklogin để kiểm tra true.
					Session::set('adminId', $value['IDAdmin']);
					Session::set('adminUser', $value['TaiKhoan']);
					header("Location:index.php");
				}else {
					$alert = "User and Pass not match";
					return $alert;
				}


		}
	}
 ?>