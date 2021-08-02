<?php include 'main/header.php'; ?>
<?php include '../class/category.php';  ?>
<?php include '../class/cart.php';  ?>
<?php include '../class/product.php';  ?>
<?php
$pd = new product();
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
    // echo "<script> window.location = 'catlist.php' </script>";

} else {
    $id = $_GET['productid']; // Lấy catid trên host
    $delProduct = $pd->del_product($id); // hàm check delete Name khi submit lên
?>
    <script type="text/javascript">
        location.href = 'productlist.php';
    </script>
<?php
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
                                <th>Tên sản phẩm</th>
                                <th>Chủng loại</th>
                                <th>Số lượng sản phẩm</th>
                                <th>Số lượng đã bán</th>
                                <th>Giá bán</th>
                                <th colspan=2>Thực hiện</th>
                                <th>ID</th>
                            </tr>
                            <?php

                            $pdlist = $pd->show_product();
                            $i = 0;


                            if ($pdlist) {

                                while ($result = $pdlist->fetch_assoc()) {
                                    $i++;
                                    if ($i % 2 == 0) { ?>
                                        <tr class="EVEN">
                                        <?php
                                    } else { ?>
                                        <tr>
                                        <?php } ?>
                                        <td class="NO"><?php echo $i; ?></td>
                                        <td class="NAME"><?php echo $result['TenSanPham']; ?></td>
                                        <td class="NAME"><?php echo $result['TenChungLoaiSP']; ?></td>
                                        <td class="NO"><?php echo $result['SoLuong']; ?></td>
                                        <td class="NO"><?php echo $result['SoLuongBan']; ?></td>
                                        <td class="NO"><?php echo $result['GiaBan']; ?></td>
                                        <td class="ED"><a href="productedit.php?productid=<?php echo $result['MaSanPham'] ?>">Edit</a></td>
                                        <td class="ED"><a onclick="return confirm('Are you want to delete???')" href="?productid=<?php echo $result['MaSanPham'] ?>">Delete</a></td>
                                        <td class="ID"><?php echo $result['MaSanPham']; ?></td>
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