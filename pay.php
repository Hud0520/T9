<?php include('main/header.php') ?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>
<?php 
	if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
       $customer_id = Session::get('customer_id');
       $insertOrder = $ct->insertOrder($customer_id);
       $delCart = $ct->del_all_data_cart();
       header('Location:order.php?success=true');
    }
 ?>
<div class="row view">
    <div class="col-md-6">
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
                if ($get_product_cart) { ?>
                    <table cellspacing=0 class="tblview">
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá </th>
                            <th>Số lượng</th>
                            <th>Tổng giá</th>

                        </tr><?php
                                $i = 0;
                                $subtotal = 0;
                                while ($result = $get_product_cart->fetch_assoc()) {

                                    $i++;
                                    if ($i % 2 == 0) { ?>
                                <tr class="EVEN">
                                <?php
                                    } else { ?>
                                <tr>
                                <?php } ?>
                                <td class="NO"><?php echo $i ?></td>
                                <td class="NANE"><?php echo $result['TenSanPham']; ?></td>
                                <td class="DATE"><?php echo $result['GiaBan'] . ' VND'; ?></td>
                                <td class="DATE"><?php echo $result['SoLuong'] ?></td>
                                <td class="NAME"><?php $total = $result['SoLuong'] * $result['GiaBan'];
                                                    echo $total; ?></td>
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
                                <th colspan="4" class="text-center font-weight-bold">Tổng Thanh Toán</th>
                                <td colspan="1" class="NAME">
                                    <?php echo $subtotal . " VND";

                                    ?>
                            </tr>
                            <tr>
                                <th colspan="4">VAT(10%) : </th>
                                <td colspan="1" class="NAME"><?php echo $subtotal * 0.1 . " VND";

                                                                ?></td>
                            </tr>
                            <tr>
                                <th colspan="4">Grand Total :</th>
                                <td colspan="1" class="NAME"><?php
                                                                $vat = $subtotal * 0.1;
                                                                $grandTotal = $subtotal + $vat;
                                                                echo $grandTotal . " VND";
                                                                ?> </td>
                            </tr>
                    </table>
                <?php
                        }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
    <div class="content">
            <div class="row font-weight-bold border border-primary m-2">
                <h4>Thông tin giao hàng</h4>
            </div>
            <div class="m-2 row">
                <?php
                $id= Session::get('customer_id');

                $get_cs = $cs->show_customers($id);
                if ($get_cs) {
                    while ($rs = $get_cs->fetch_assoc()) { ?>
                    <table cellspacing=0 class="tblview">
                        <tr class="EVEN">
                            <th>Họ tên :</th>
                            <td class="NAME"><?php echo $rs['TenKH'] ?></td>
                        </tr>
                        <tr>
                            <th>Email :</th>
                            <td class="NAME"><?php echo $rs['email'] ?></td>
                        </tr>
                        <tr class="EVEN">
                            <th>Số điện thoại :</th>
                            <td class="NAME"><?php echo $rs['SDT'] ?></td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td class="NAME"><?php echo $rs['DiaChi'] ?></td>
                        </tr>
                    </table>
                <?php
                        }
                }
                ?>
            </div>
            <div class="text-center">
            <button type="button" class="btn btn-warning">Sửa thông tin </button>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
						<div class="col-md-6 text-right">
							<a href="index.php"><button class="btn btn-primary" type="button">Trang chủ</button></a>
						</div>
						<div class="col-md-6 text-left">
							<a href="?orderid=order">
                                <button class="btn btn-success" type="submit">Đặt Hàng</button>
                            </a>
						</div>
					</div>
<?php include('main/footer.php') ?>