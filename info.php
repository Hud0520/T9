<?php
include 'main/header.php';
?>
<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>
<div class="row view">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <div class="content">
        <div class="row font-weight-bold border border-primary m-2">
            <h4>Thông tin khách hàng</h4>
        </div>
        <div class="m-2 row">
            
            <?php
            $id = Session::get('customer_id');

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
            <button type="button" class="btn btn-warning">Sửa thông tin </button>&nbsp;&nbsp;
            <button type="button" class="btn btn-warning">Đổi mật khẩu </button>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

</div>
<?php include('main/footer.php') ?>