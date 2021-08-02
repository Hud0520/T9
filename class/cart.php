<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
?>


 
<?php 
	/**
	* 
	*/
	class cart
	{
		private $db;
		
		public function __construct()
		{
			$this->db = new Database();
			
		}
		public function add_to_cart($id, $quantity)
		{
			
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$id = mysqli_real_escape_string($this->db->link, $id);
			$sId = session_id();

			$query = "SELECT * FROM sanpham WHERE MaSanPham = '$id' ";
			$result = $this->db->select($query)->fetch_assoc();

			$productName = $result['TenSanPham'];
			$price = $result['GiaBan'];
			
			if($result['SoLuong']>$quantity){
			
				$query_insert = "INSERT INTO cart (MaSanPham,TenSanPHam,SoLuong,sId,GiaBan) VALUES('$id','$productName','$quantity','$sId','$price') ";
				$insert_cart = $this->db->insert($query_insert);
				if($insert_cart){
					$this->reload();
					header('Location:detail.php?proid='.$id);
				}else {
					header('Location:404.php');
				}
			}else{
				$msg = "<span class='text-warning'> Số lượng ".$quantity." bạn đặt quá số lượng chúng tôi chỉ còn ".$result['product_remain']." cái</span> ";
				return $msg;
			}
			

		}
		public function reload(){
			$sid = session_id();
			$sql="SELECT SUM(SoLuong) as SL, SUM(SoLuong*GiaBan) as TT FROM cart WHERE sId ='$sid' GROUP By sId";
			$rs = $this->db->select($sql)->fetch_assoc();
			
			Session::set('sum',$rs['TT']);
			Session::set('qty',$rs['SL']);
		}
		public function get_product_cart()
		{
			$sId = session_id();
			$query = "SELECT * FROM cart WHERE sId = '$sId' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_quantity_Cart($proId,$cartId, $quantity)
		{
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$cartId = mysqli_real_escape_string($this->db->link, $cartId);
			$proId = mysqli_real_escape_string($this->db->link, $proId);

			$query_product = "SELECT * FROM sanpham WHERE MaSanPham = '$proId' ";
			$result_product = $this->db->select($query_product)->fetch_assoc();
			if($quantity<$result_product['SoLuong']){
				$query = "UPDATE cart SET

				SoLuong = '$quantity'

				WHERE cartId = '$cartId'";

				$result = $this->db->update($query);
				if ($result) {
					$this->reload();
					header('Location:cart.php');
				}else {
					$msg = "<span class='text-warning'> Product Quantity Update NOT Succesfully</span> ";
					return $msg;
				}
			}else{
				$msg = "<span class='text-warning'> Số lượng ".$quantity." bạn đặt quá số lượng chúng tôi chỉ còn ".$result_product['SoLuong']." cái</span> ";
				return $msg;
			}

		}
		public function del_product_cart($cartid){
			$cartid = mysqli_real_escape_string($this->db->link, $cartid);
			$query = "DELETE FROM cart WHERE cartId = '$cartid'";
			$result = $this->db->delete($query);
			if($result){
				header('Location:cart.php');
			}else{
				$msg = "<span class='error'>Sản phẩm đã được xóa</span>";
				return $msg;
			}
		}

		public function check_cart()
		{
			$sId = session_id();
			$query = "SELECT * FROM cart WHERE sId = '$sId' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function check_order($customer_id)
		{
			$sId = session_id();
			$query = "SELECT * FROM hoadon WHERE MaKH = '$customer_id' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_all_data_cart()
		{
			$sId = session_id();
			$query = "DELETE FROM cart WHERE sId = '$sId' ";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function insertOrder($customer_id)
		{
			$sId = session_id();
			$query = "SELECT * FROM cart WHERE sId = '$sId'";
			$get_product = $this->db->select($query);
			if($get_product){
				while($result = $get_product->fetch_assoc()){
					$productid = $result['MaSanPham'];
					$quantity = $result['SoLuong'];
					$price = $result['GiaBan'];
					$customer_id = $customer_id;
					$query_order = "INSERT INTO hoadon(MaKH) VALUES($customer_id)";
					$insert_order = $this->db->insert($query_order);
					$sql ="UPDATE sanpham SET SoLuong=SoLuong-$quantity WHERE MaSanPham = '$productid'";
					$insert_order = $this->db->update($sql);
					$sql= "SELECT MaHD FROM hoadon WHERE MaKH=$customer_id ORDER By MaHD DESC LIMIT 1";
					$rs=$this->db->select($sql)->fetch_assoc();
					$MaHD=$rs['MaHD'];
					$TT=$quantity*$price;
					$sql = "INSERT INTO chitiethoadon(MaHD,MaSanPham,DonGia,SoLuong,ThanhTien) VALUES ('$MaHD','$productid','$price','$quantity','$TT')";
					$insert = $this->db->insert($sql);	
				}
			}
		}

		public function get_cart_ordered($customer_id)
		{
			$query = "SELECT TenSanPham,NgayBan,ThanhTien,chitiethoadon.SoLuong FROM chitiethoadon INNER JOIN hoadon ON hoadon.MaHD=chitiethoadon.MaHD INNER JOIN sanpham ON chitiethoadon.MaSanPham = sanpham.MaSanPham WHERE MaKH = '$customer_id' ORDER BY chitiethoadon.MaHD DESC ";
			$get_cart_ordered = $this->db->select($query);
			return $get_cart_ordered;
		}
		public function get_ord_cart()
		{
			$query = "SELECT hoadon.MaHD,TenNhanVien,TenKH,NgayBan,SUM(ThanhTien) as Tong FROM chitiethoadon INNER JOIN hoadon ON hoadon.MaHD=chitiethoadon.MaHD INNER JOIN nhanvien ON hoadon.MaNhanVien= nhanvien.MaNhanVien INNER JOIN khachhang ON hoadon.MaKH = khachhang.MaKH";
			$get_inbox_cart = $this->db->select($query);
			return $get_inbox_cart;
		}
		
		public function shifted($id,$proid,$qty,$time,$price)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$proid = mysqli_real_escape_string($this->db->link, $proid);
			$qty = mysqli_real_escape_string($this->db->link, $qty);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);

			$query_select = "SELECT * FROM tbl_product WHERE productId='$proid'";
			$get_select = $this->db->select($query_select);

			if($get_select){
				while($result = $get_select->fetch_assoc()){
					$soluong_new = $result['product_remain'] - $qty;
					$qty_soldout = $result['product_soldout'] + $qty;

					$query_soluong = "UPDATE tbl_product SET

					product_remain = '$soluong_new',product_soldout = '$qty_soldout' WHERE productId = '$proid'";
					$result = $this->db->update($query_soluong);
				}
			}

			$query = "UPDATE tbl_order SET

			status = '1'

			WHERE id = '$id' AND date_order = '$time' AND price = '$price' ";


			$result = $this->db->update($query);
			if ($result) {
				$msg = "<span class='success'> Update Order Succesfully</span> ";
				return $msg;
			}else {
				$msg = "<span class='text-warning'> Update Order NOT Succesfully</span> ";
				return $msg;
			}
		}
		public function del_shifted($id,$time,$price)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "DELETE FROM tbl_order 
					  WHERE id = '$id' AND date_order = '$time' AND price = '$price' ";

			$result = $this->db->update($query);
			if ($result) {
				$msg = "<span class='success'> DELETE Order Succesfully</span> ";
				return $msg;
			}else {
				$msg = "<span class='text-warning'> DELETE Order NOT Succesfully</span> ";
				return $msg;
			}
		}
		public function shifted_confirm($id,$time,$price)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "UPDATE tbl_order SET

			status = '2'

			WHERE customer_id = '$id' AND date_order = '$time' AND price = '$price' ";

			$result = $this->db->update($query);
			return $result;
		}
	}
 ?>