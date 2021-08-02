<?php include('main/header.php') ?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
    echo "<h1>File not fourd</h1>";
} else {
    $id = $_GET['proid']; // Lấy productid trên host
}
$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $quantity = $_POST['quantity'];
    $insertCart = $ct->add_to_cart($id, $quantity); // hàm check catName khi submit lên
}
?>
<div class="row mt-2">
    <div class="col-md-4">
        <div class="img-lg rounded mx-auto">
        </div>
    </div>
    <div class="col-md-4">
        <?php $pro = $product->getproductbyId($id);
        if ($pro) {
            while ($rs = $pro->fetch_assoc()) {
        ?>
                <div class="row">
                    <div class="col-sm-12">
                        <h3><?php echo $rs['TenSanPham'] ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">...</div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>Danh mục : <span class="text-success"><?php echo $rs['TenChungLoaiSP'] ?></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>Giá bán : <span class="text-success"><?php echo $rs['GiaBan'] ?></span></p>
                    </div>
                </div>

                <form method="POST">
                    <div class="form-group row">
                        <label for="input" class="col-sm-4 col-form-label">Số lượng :</label>
                        <?php if ($rs['SoLuong'] == 0) { ?>
                            <div class="col-sm-6">
                                <p class="bg-danger form-control text-white">Hết Hàng</p>
                            </div><?php } else { ?>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="input" name="quantity" value="1" min="1" max="<?php echo $rs['SoLuong'] ?>">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Thêm vào giỏi hàng</button>&nbsp;&nbsp;&nbsp;

                            <button type="button" onclick="Location :javascript:history.back();" class="btn btn-primary">Trở lại <i class="fas fa-sign-out-alt"></i></button>

                        </div>
                    </div>
                </form>

    </div>

</div>
<div class="container-md ">
    
    <div class="row">
        <div class="col-md-8 py-3 bg-light">
            <h4>Chi tiết sản phẩm</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <p>Danh mục : <span class="text-success"><?php echo $rs['TenChungLoaiSP'] ?></span></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <p>Số lượng còn : <span class="text-success"><?php echo $rs['SoLuong'] ?></span></p>
        </div>
    </div>
</div>
<?php
            }
        }
?>

<?php include('main/footer.php') ?>