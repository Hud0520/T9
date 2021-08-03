<?php

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
?>

<?php 
	/**
	* 
	*/
	class product
	{
		private $db;
		public function __construct()
		{
			$this->db = new Database();
		}

		public function insert_product($data){
			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$product_code = mysqli_real_escape_string($this->db->link, $data['product_code']);

			$productQuantity = mysqli_real_escape_string($this->db->link, $data['productQuantity']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			
			$price = mysqli_real_escape_string($this->db->link, $data['price']);

			if($product_code =='' || $productName == "" || $productQuantity == "" || $category == ""  || $price == "" ){
				$alert = "<span class='text-warning'>Field must be not empty</span>";
				return $alert;
			}else{
				
				$query = "INSERT INTO sanpham(TenSanPham,MaSanPham,SoLuong,MaChungLoaiSP,GiaBan) VALUES('$productName','$product_code','$productQuantity','$category','$price') ";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='text-success'>Insert Product Successfully</span>";
					return $alert;
				}else {
					$alert = "<span class='text-warning'>Insert Product NOT Success</span>";
					return $alert;
				}
			}
		}
		public function show_product()
		{
			$query = 
			"SELECT sanpham.MaSanPham,sanpham.SoLuong,GiaBan,TenChungLoaiSP,TenSanPham,sum(chitiethoadon.SoLuong) as SoLuongBan FROM sanpham INNER JOIN chungloaisp ON sanpham.MaChungLoaiSP = chungloaisp.MaChungLoaiSP LEFT JOIN chitiethoadon ON sanpham.MaSanPham = chitiethoadon.MaSanPham GROUP BY sanpham.MaSanPham order by sanpham.MaSanPham desc LIMIT 0, 25;";
			// $query = "SELECT * FROM tbl_product order by productId desc ";
			$result = $this->db->select($query);
			return $result;
		}

		public function get_product($catid){
			$query = "SELECT * FROM sanpham WHERE MaChungLoaiSP = '$catid' ORDER BY MaSanPham";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function update_product($data,$id){
	
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$productQuantity = mysqli_real_escape_string($this->db->link, $data['productQuantity']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			
			$price = mysqli_real_escape_string($this->db->link, $data['price']);

			if( $productName == "" || $productQuantity == "" || $category == ""  || $price == "" ){
				$alert = "<span class='text-warning'>Field must be not empty</span>";
				return $alert;
			}else{
					$query = "UPDATE sanpham SET
					TenSanPham = '$productName',
					SoLuong=(SELECT SoLuong FROM sanpham WHERE MaSanPham='$id')+'$productQuantity',
					MaChungLoaiSP = '$category', 
					GiaBan = '$price'			
					WHERE MaSanPham = '$id'";
					$result = $this->db->update($query);
					if($result){
						$alert = "<span class='text-success'>Sản phẩm Updated thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='text-warning'>Sản phẩm Updated không thành công</span>";
						return $alert;
					}
				
			}

		}
		public function del_product($id)
		{
			$query = "DELETE FROM sanpham where MaSanPham = '$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "Product Deleted Successfully";
				return $alert;
			}else {
				$alert = "Product Deleted Not Success";
				return $alert;
			}
		}
		public function getproductbyId($id)
		{
			$query = "SELECT MaSanPham,TenSanPham,SoLuong,GiaBan,sanpham.MaChungLoaiSP,TenChungLoaiSP FROM sanpham INNER JOIN chungloaisp ON sanpham.MaChungLoaiSP=chungloaisp.MaChungLoaiSP where MaSanPham = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}		
		//Kết thúc Backend
		
	}
 ?>