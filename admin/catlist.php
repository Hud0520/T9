<?php include 'main/header.php'; ?>
<?php include '../class/category.php';  ?>
<?php
// gọi class category
$cat = new category();     
    if(!isset($_GET['delid']) || $_GET['delid'] == NULL){
        // echo "<script> window.location = 'catlist.php' </script>";
        
    }else {
        $id = $_GET['delid']; // Lấy catid trên host
        $delCat = $cat -> del_category($id); // hàm check delete Name khi submit lên
    }
?>
<div class="col-md-10">
    <div class="view bg-light text-dark">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <div class="font-weight-bold border border-primary p-2">Danh sách danh mục</div>
                    <div class="m-2">
                    <table cellspacing=0 class="tblview">
                    <tr>
                        <th>STT</th>
                        <th>Tên Danh Mục</th>
                        <th colspan=2>Thực hiện</th>
                        <th>ID</th>
                    </tr>
                        <?php 
							$show_cat = $cat -> show_category();
							if($show_cat){
								$i = 0;
								while($result = $show_cat -> fetch_assoc()){
									$i++;
                                    if($i %2 ==0){?>
                                        <tr class="EVEN">
                                    <?php
                                    }else{?>
                                        <tr>
                                    <?php } ?>
							<td class="NO"><?php echo $i; ?></td>
							<td class="NAME"><?php echo $result['TenChungLoaiSP']; ?></td>
							<td class="ED"><a href="catedit.php?catid=<?php echo $result['MaChungLoaiSP']; ?>">Edit</a></td>
                            <td class="ED"><a onclick = "return confirm('Are you want to delete???')" href="?delid=<?php echo $result['MaChungLoaiSP'] ?>">Delete</a></td>
                            <td class="ID"><?php echo $result['MaChungLoaiSP']; ?></td>
                            </tr>
                        <?php 
							}
						}
						 ?>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include 'main/footer.php'; ?>