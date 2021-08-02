<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
?>


 
<?php 
	/**
	* 
	*/
	class user
	{
		private $db;
		public function __construct()
		{
			$this->db = new Database();
		}
	}
 ?>