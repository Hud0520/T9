<?php include 'main/header.php'; ?>
<?php include '../class/category.php';  ?>
<?php include '../class/product.php';  ?>
<?php
// gọi class category
$pd = new product();
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
    echo "<script> window.location = 'productlist.php' </script>";
} else {
    $id = $_GET['productid']; // Lấy productid trên host
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $updateProduct = $pd->update_product($_POST, $id); // hàm check catName khi submit lên
}
?>
<div class="col-md-10">
    <div class="view bg-light text-dark">
        <div class="row">
            <div class="col-md-12">

                <div class="content">
                    <div class="font-weight-bold border border-primary p-2">Cập nhật sản phẩm</div>
                    <div class="m-2">
                        <div class=" row p-3">
                            <div class="col-md-6 text-center ">
                                <?php
                                if (isset($updateProduct)) {
                                    echo $updateProduct;
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        $get_product_by_id = $pd->getproductbyId($id);
                        if ($get_product_by_id) {
                            while ($result_product = $get_product_by_id->fetch_assoc()) {


                        ?>
                                <form name="frmLogin" action="" method="post" enctype="multipart/form-data">
                                    <div class="">
                                        <div class="form-group row ">
                                            <label class="col-md-2 text-right col-form-label" for="txtName">Tên sản phẩm</label>
                                            <div class="col-md-4"><input value="<?php echo $result_product['TenSanPham'] ?>" type="text" id="txtName" class="form-control" name="productName" /></div>
                                        </div>

                                        <div class="form-group row ">
                                            <label class="col-md-2 text-right col-form-label" for="txtName1" >Mã sản phẩm</label>
                                            <div class="col-md-4"><input value="<?php echo $result_product['MaSanPham'] ?>" disabled type="text" id="txtName1" class="form-control" name="product_code" /></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 text-right col-form-label" for="txtName2">Số lượng trong còn lại</label>
                                            <div class="col-md-4"><input value="<?php echo $result_product['SoLuong'] ?>" type="text" id="txtName2" class="form-control" /></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 text-right col-form-label" for="txtName3">Số lượng nhập thêm</label>
                                            <div class="col-md-4"><input value="0" type="text" id="txtName3" class="form-control" name="productQuantity" /></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 text-right col-form-label" for="txtName4">Giá bán</label>
                                            <div class="col-md-4"><input value="<?php echo $result_product['GiaBan'] ?>" type="text" id="txtName4" class="form-control" name="price" /></div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 text-right col-form-label" for="txtName5">Loại sản phẩm</label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="category" id="txtName5">
                                                    <option>Chọn chuyên mục</option>
                                                    <?php
                                                    $cat = new category();
                                                    $catlist = $cat->show_category();
                                                    if ($catlist) {
                                                        while ($result = $catlist->fetch_assoc()) {
                                                    ?>
                                                            <option <?php
                                                                    if ($result['MaChungLoaiSP'] == $result_product['MaChungLoaiSP']) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?> value=" <?php echo $result['MaChungLoaiSP'] ?> "> <?php echo $result['TenChungLoaiSP'] ?> </option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row p-3">
                                            <div class="col-md-6 text-center">
                                                <button type="submit" class="btn btn-primary " id="btnReg"><i class="fas fa-sign-in-alt"></i>Cập nhật</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <button type="button" class="btn btn-primary" onClick="location.href='productlist.php'">Exit <i class="fas fa-sign-out-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Load TinyMCE -->
<?php include 'main/footer.php'; ?>