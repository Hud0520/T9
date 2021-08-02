<?php include 'main/header.php'; ?>
<?php include '../class/category.php';  ?>
<?php
$cat = new category();
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script> window.location = 'catlist.php' </script>";
} else {
    $id = $_GET['catid']; // Lấy catid trên host
}
// gọi class category
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $catName = $_POST['catName'];
    $updateCat = $cat->update_category($catName, $id); // hàm check catName khi submit lên
}

?>
<div class="col-md-10">
    <div class="view bg-light text-dark">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <div class="font-weight-bold border border-primary p-2">Cập nhật danh mục</div>
                    <div class="m-2">

                        <?php
                        $get_cat_name = $cat->getcatbyId($id);
                        if ($get_cat_name) {
                            while ($result = $get_cat_name->fetch_assoc()) {


                        ?>
                                <form name="frmLogin" action="" method="post">
                                    <div class="form-group row">
                                        <label class="col-md-2 text-right col-form-label" for="txtName">Loại sản phẩm mới</label>
                                        <div class="col-md-4"><input type="text" value="<?php echo $result['TenChungLoaiSP']; ?>" id="txtName" class="form-control" name="catName" /></div>
                                    </div>
                                    <div class=" row p-3">
                                        <div class="col-md-12 ">
                                            <?php
                                            if (isset($updateCat)) {
                                                echo $updateCat;
                                            }
                                            ?>
                                        </div>
                                    </div>
                            <?php
                            }
                        }

                            ?>
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" id="btnReg"></i>Cập nhật</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" class="btn btn-primary" onClick="location.href='catlist.php'">Exit <i class="fas fa-sign-out-alt"></i></button>
                                </div>
                            </div>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include 'main/footer.php'; ?>