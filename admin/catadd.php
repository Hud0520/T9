<?php include 'main/header.php'; ?>
<?php include '../class/category.php';  ?>
<?php
// gọi class category
$cat = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $catName = $_POST['catName'];
    $insertCat = $cat->insert_category($catName); // hàm check catName khi submit lên
}
?>
<div class="col-md-10">
    <div class="view bg-light text-dark">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <div class="font-weight-bold border border-primary p-2">Thêm danh mục</div>
                    <div class="m-2">
                        
                        <form name="frmLogin" action="catadd.php" method="post">
                            <div class="form-group row">
                                <label class="col-md-2 text-right col-form-label" for="txtName">Loại sản phẩm mới</label>
                                <div class="col-md-4"><input type="text" id="txtName" class="form-control"name="catName" /></div>
                            </div>
                            <div class=" row p-3">
                                <div class="col-md-12 ">
                                <?php
                                if (isset($insertCat)) {
                                    echo $insertCat;
                                }
                                ?>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" id="btnReg"><i class="fas fa-sign-in-alt"></i>Thêm</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" class="btn btn-primary" onClick="location.href='index.php'">Exit <i class="fas fa-sign-out-alt"></i></button>
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