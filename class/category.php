<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
?>


 
<?php 
	/**
	* 
	*/
	class category
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
		}
		public function insert_category($catName){
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			 //mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db
			 $query = "SELECT * FROM chungloaisp WHERE TenChungLoaiSP = '$catName' ";
			 $result = $this->db->select($query);
			if(empty($catName)){
				$alert = "<span class='text-warning'>Category must be not empty</span>";
				return $alert;
			}else if($result){
				$alert = "<span class='text-warning'>Category is exist</span>";
				return $alert;
			}else{
				$query = "INSERT INTO chungloaisp(TenChungLoaiSP) VALUES('$catName') ";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='text-success'>Insert Category Successfully</span>";
					return $alert;
				}else {
					$alert = "<span class='text-warning'>Insert Category NOT Success</span>";
					return $alert;
				}
			}
		}
		public function show_category()
		{
			$query = "SELECT * FROM chungloaisp order by MaChungLoaiSP desc ";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_category($catName,$id)
		{
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$id = mysqli_real_escape_string($this->db->link, $id);

			$query = "SELECT * FROM chungloaisp WHERE TenChungLoaiSP = '$catName' ";
			$result = $this->db->select($query);
			if(empty($catName)){
				$alert = "<span class='text-warning'>Category must be not empty</span>";
				return $alert;
			}else if($result){
				$alert = "<span class='text-warning'>Category is exist</span>";
				return $alert;
			}else{
				$query = "UPDATE chungloaisp SET catName= '$catName' WHERE MaChungLoaiSP = '$id' ";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='text-success'>Category Update Successfully</span>";
					return $alert;
				}else {
					$alert = "<span class='text-warning'>Update Category NOT Success</span>";
					return $alert;
				}
			}

		}
		public function del_category($id)
		{
			$query = "DELETE FROM chungloaisp where MaChungLoaiSP = '$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='text-success'>Category Deleted Successfully</span>";
				return $alert;
			}else {
				$alert = "<span class='text-success'>Category Deleted Not Success</span>";
				return $alert;
			}
		}
		public function getcatbyId($id)
		{
			$query = "SELECT * FROM chungloaisp where MaChungLoaiSP = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_category_fontend()
		{
			$query = "SELECT * FROM chungloaisp order by MaChungLoaiSP desc ";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_product_by_cat($id)
		{
			$query = "SELECT * FROM sanpham where MaChungLoaiSP = '$id' order by MaChungLoaiSP desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_name_by_cat($id)
		{
			$query = "SELECT sanpham.*,chungloaisp.catName,chungloaisp.MaChungLoaiSP 
					  FROM sanpham,chungloaisp 
					  WHERE sanpham.MaChungLoaiSP = chungloaisp.MaChungLoaiSP
					  AND sanpham.MaChungLoaiSP ='$id' LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}
	}
 ?>