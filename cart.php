<?php include('main/header.php') ?>
<?php
if (isset($_GET['cartid'])) {
    $cartid = $_GET['cartid'];
    $delcart = $ct->del_product_cart($cartid);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $cartId = $_POST['cartId'];
    $proId = $_POST['proId'];
    $quantity = $_POST['quantity'];
    $update_quantity_Cart = $ct->update_quantity_Cart($proId, $cartId, $quantity); // hàm check catName khi submit lên
    if ($quantity <= 0) {
        $delcart = $ct->del_product_cart($cartId);
    }
}
?>
<div class="row view">
    <div class="col-md-12">

        <div class="content">
            <div class="font-weight-bold border border-primary m-2">
                <h4>Giỏ hàng của bạn</h4>
                <?php
                if (isset($update_quantity_Cart)) {
                    echo $update_quantity_Cart;
                }
                ?>
                <?php
                if (isset($delcart)) {
                    echo $delcart;
                }
                ?>
                <?php
                if (isset($delcart)) {
                    echo $delcart;
                }
                ?>
            </div>
            <div class="m-2">
                    <?php

                    $get_product_cart = $ct->get_product_cart();
                    if ($get_product_cart) {?>
                        <table cellspacing=0 class="tblview">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá </th>
                        <th>Số lượng</th>
                        <th>Tổng giá</th>
                        <th colspan="2">Thực hiện</th>
                    </tr><?php
                        $i = 0;
                        $subtotal=0;
                        while ($result = $get_product_cart->fetch_assoc()) {

                            $i++;
                            if ($i % 2 == 0) { ?>
                                <tr class="EVEN">
                                <?php
                            } else { ?>
                                <tr>
                                <?php } ?>
                                <td class="NAME"><?php echo $result['TenSanPham'] ?></td>
                                <td class="DATE"><?php echo $result['GiaBan'] . ' VND'; ?></td>
                                <td class="ADDRESS">
                                    <form method="POST">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto ">
                                                <input type="text" class=" sr-only form-control" name="cartId" min="0" value="<?php echo $result['cartId'] ?>" />
                                            </div>
                                            <div class="col-auto ">
                                                <input type="text" class=" sr-only form-control " name="proId" min="0" value="<?php echo $result['MaSanPham'] ?>" />
                                            </div>
                                            <div class="col-auto">
                                                <input type="number" class="form-control " name="quantity" min="0" value="<?php echo $result['SoLuong'] ?>" />
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td class="ED"><?php $total = $result['SoLuong'] * $result['GiaBan'];
                                                echo $total; ?></td>
                                <td colspan="2" class="ED "><a href="?cartid=<?php echo $result['cartId'] ?>" class="text-danger">Xóa</a></td>
                                </tr>
                        <?php
                            $subtotal += $total;
                            $qty = $qty + $result['SoLuong'];
                        }
                    }
                        ?>
                        <?php
                        $check_cart = $ct->check_cart();
                        if ($check_cart) {

                        ?>
                            <tr>
                                <th colspan="3" class="text-center font-weight-bold">Tổng Thanh Toán</th>
                                <td colspan="2">
                                    <?php echo $subtotal . " VND";

                                    ?>
                            </tr>
                            <tr>
                                <th colspan="3">VAT(10%) : </th>
                                <td colspan="2"><?php echo $subtotal*0.1 . " VND";?></td>
                            </tr>
                            <tr>
                                <th colspan="3">Grand Total :</th>
                                <td colspan="2"><?php
                                                $vat = $subtotal * 0.1;
                                                $grandTotal = $subtotal + $vat;
                                                echo $grandTotal . " VND";
                                                ?> </td>
                            </tr>
                </table>
                <div class="row mt-4">
						<div class="col-md-6 text-right">
							<a href="product.php"><button class="btn btn-primary" type="button">Tiếp tục mua sắm</button></a>
						</div>
						<div class="col-md-6 text-left">
							<a href="pay.php">
                                <button class="btn btn-primary" type="submit">Đặt Hàng</button>
                            </a>
						</div>
					</div>
            <?php
                        } else {
                            echo 'Giỏ của bạn trống ';
                        }
            ?>
            </div>
        </div>
    </div>
</div>
<?php include('main/footer.php');
