<?php
include 'main/header.php';
?>
<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
if (isset($_GET['success'] ) ) {
        $message = 'Đặt hàng thành công. Chúng tôi sẽ liên hệ lại với bạn sớm. Chân thành cảm ơn!';
    echo "<script type='text/javascript'>alert('$message');</script>";
    header('Location:order.php');
}
?>
<div class="view ">
    <div class="row">
        <div class="col-md-12">

            <div class="content">
                <div class="font-weight-bold border border-primary p-2">Đơn hàng của bạn</div>
                <div class="m-2">
                    <table cellspacing=0 class="tblview">
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Ngày đặt</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th colspan="2">Thực hiện</th>
                        </tr>
                        <?php
							$customer_id = Session::get('customer_id');  
							$get_cart_ordered = $ct->get_cart_ordered($customer_id);
							if($get_cart_ordered){
								$i=0;
								$qty = 0;
								while ($result = $get_cart_ordered->fetch_assoc()) {
								$i++;
                                if ($i % 2 == 0) { ?>
                                    <tr class="EVEN">
                                    <?php
                                } else { ?>
                                    <tr>
                                    <?php } ?>
                                    <td class="NO"><?php echo $i; ?></td>
                                    <td class="NAME"><?php echo $result['TenSanPham']; ?></td>
                                    <td class="DATE">
                                        <div class="img-sm"></div>
                                    </td>
                                    
                                    <td class="DATE"><?php echo $result['NgayBan']; ?></td>
                                    <td class="DATE"><?php echo $result['SoLuong']; ?></td>
                                    <td class="DATE"><?php echo $result['ThanhTien']; ?></td>
                                    <td colspan="2" class="ED"><a href="#">Liên hệ</a></td>
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
<?php include('main/footer.php') ?>