<?php include 'main/header.php'; ?>
<?php include '../class/category.php';  ?>
<?php include '../class/product.php';  ?>
<?php
// gọi class category
$pd = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $insertProduct = $pd->insert_product($_POST); // hàm check  submit
}
?>
<div class="col-md-10">
    <div class="view bg-light text-dark">
        <div class="row">
            <div class="col-md-12">

                <div class="content">
                    <div class="font-weight-bold border border-primary p-2">Thêm sản phẩm mới</div>
                    <div class="m-2">
                        <div class=" row p-3">
                                    <div class="col-md-6 text-center ">
                                        <?php
                                        if (isset($insertProduct)) {
                                            echo $insertProduct;
                                        }
                                        ?>
                                    </div>
                                </div>
                        <form name="frmLogin" action="productadd.php" method="post" enctype="multipart/form-data">
                            <div class="">
                                <div class="form-group row ">
                                    <label class="col-md-2 text-right col-form-label" for="txtName">Tên sản phẩm</label>
                                    <div class="col-md-4"><input type="text" id="txtName" class="form-control" name="productName" /></div>
                                </div>

                                <div class="form-group row ">
                                    <label class="col-md-2 text-right col-form-label" for="txtName">Mã sản phẩm</label>
                                    <div class="col-md-4"><input type="text" id="txtName" class="form-control" name="product_code" /></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 text-right col-form-label" for="txtName">Số lượng sản phẩm</label>
                                    <div class="col-md-4"><input type="text" id="txtName" class="form-control" name="productQuantity" /></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 text-right col-form-label" for="txtName">Giá bán</label>
                                    <div class="col-md-4"><input type="text" id="txtName" class="form-control" name="price" /></div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 text-right col-form-label" for="txtName">Loại sản phẩm</label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="category">
                                            <option>Chọn chuyên mục</option>
                                            <?php
                                            $cat = new category();
                                            $catlist = $cat->show_category();
                                            if ($catlist) {
                                                while ($result = $catlist->fetch_assoc()) {
                                            ?>
                                                    <option value=" <?php echo $result['MaChungLoaiSP'] ?> "> <?php echo $result['TenChungLoaiSP'] ?> </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row p-3">
                                    <div class="col-md-6 text-center">
                                        <button type="submit" class="btn btn-primary " id="btnReg"><i class="fas fa-sign-in-alt"></i>Thêm</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="button" class="btn btn-primary" onClick="location.href='index.php'">Exit <i class="fas fa-sign-out-alt"></i></button>
                                    </div>
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
<!-- Load TinyMCE -->
<?php include 'main/footer.php'; ?>