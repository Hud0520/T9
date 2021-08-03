<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
?>


 
<?php 
	/**
	* 
	*/
	class customer
	{
		private $db;
		public function __construct()
		{
			$this->db = new Database();

		}
		public function insert_customer($date)
		{
			$name = mysqli_real_escape_string($this->db->link, $date['name']);
			$email = mysqli_real_escape_string($this->db->link, $date['email']);
			$address = mysqli_real_escape_string($this->db->link, $date['address']);
			$phone = mysqli_real_escape_string($this->db->link, $date['phone']);
			$password = mysqli_real_escape_string($this->db->link, $date['password']);

			if($name == ""  || $email == "" || $address == ""  || $phone == "" || $password == ""){
				$alert = "<span class='text-warning'>Fiedls must be not empty</span>";
				return $alert;
			}else{
				$check_email = "SELECT * FROM khachhang WHERE email='$email' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if ($result_check) {
					$alert = "<span class='text-warning'>The Email Already Exists??? Please Enter Another Email </span>";
					return $alert;
				}else {
					$query = "INSERT INTO khachhang(TenKH,email,DiaChi,SDT,password) VALUES('$name','$email','$address','$phone','$password') ";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='text-success'>Insert Customer Successfully</span>";
						return $alert;
					}else {
						$alert = "<span class='text-warning'>Insert Customer NOT Success</span>";
						return $alert;
					}
				}
			}
		}
		public function login_customer($date)
		{
			$email =  $date['email'];
			$password = $date['password'];
			if($email == '' || $password == ''){
				$alert = "<span class='text-warning'>Email And Password must be not empty</span>";
				return $alert;
			}else{
				$check_login = "SELECT * FROM khachhang WHERE email='$email' AND password='$password' ";
				$result_check = $this->db->select($check_login);
				if ($result_check != false) {
					$value = $result_check->fetch_assoc();
					Session::set('customer_login', true);
					Session::set('customer_id', $value['MaKH']);
					Session::set('customer_name', $value['TenKH']);
					header('Location:index.php');
				}else {
					$alert = "<span class='text-warning'>Email or Password doesn't match</span>";
					return $alert;
				}
			}
		}
		public function show_customers($id)
		{
			$query = "SELECT * FROM khachhang WHERE MaKH='$id' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_customers($data, $id)
		{
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			
			if($name==""  || $email=="" || $address=="" || $phone ==""){
				$alert = "<span class='text-warning'>Fields must be not empty</span>";
				return $alert;
			}else{
				$query = "UPDATE tbl_customer SET name='$name',email='$email',address='$address',phone='$phone' WHERE id ='$id'";
				$result = $this->db->insert($query);
				if($result){
						$alert = "<span class='text-success'>Khách hàng Updated thành công</span>";
						return $alert;
				}else{
						$alert = "<span class='text-warning'>Khách hàng Updated Not thành công</span>";
						return $alert;
				}
				
			}
		}

	}
 ?>