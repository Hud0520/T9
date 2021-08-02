<?php include 'main/header.php';?>
<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../class/cart.php');
 ?>
            <div class="col-md-10">
                <div class="view bg-light text-dark">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="content">
                                <div class="font-weight-bold border border-primary p-2">Đơn hàng</div>
                                <div class="m-2">
                                <table cellspacing=0 class="tblview">
                            <tr>
                                <th>STT</th>
                                <th>Ngày đặt</th>
                                <th>Khách hàng</th>
                                <th>Nhân viên</th>
                                <th>Tổng </th>
                                <th colspan="2">Thực hiện</th>
                                <th>ID</th>
                            </tr>
                            <?php

                            $ct= new cart();
                            


                            $get_ord_cart = $ct -> get_ord_cart();
						    if ($get_ord_cart) {
							$i=0;
							while ($result = $get_ord_cart->fetch_assoc()) {
								$i++;
                                if ($i % 2 == 0) { ?>
                                    <tr class="EVEN">
                                <?php
                                } else { ?>
                                    <tr>
                                    <?php } ?>
                                    <td class="NO"><?php echo $i; ?></td>
                                    <td class="DATE"><?php echo $result['NgayBan']; ?></td>
                                    <td class="NAME"><?php echo $result['TenKH']; ?></td>
                                    <td class="NAME"><?php echo $result['TenNhanVien']; ?></td>
                                    <td class="NO"><?php echo $result['Tong']; ?></td>
                                    <td colspan="2" class="ED"><a href="#">Xem chi tiết</a></td>
                                    <td class="ID"><?php echo $result['MaHD']; ?></td>
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
<?php include 'main/footer.php';?>