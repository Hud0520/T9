<?php include('main/header.php'); ?>
<?php
$login_check = Session::get('customer_login');

?>
<?php
// gọi class category

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $insertCustomer = $cs->insert_customer($_POST); // hàm check catName khi submit lên
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $login_Customer = $cs->login_customer($_POST); // hàm check catName khi submit lên
}
?>
<div class="row mt-4">
    <div class="col-lg-4 col-md-12">
        <div class="col-md-12 border border-primary rounded bg-light">
            <form name="frmLogin" action="" method="POST">
                <div class="loginview">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title text-center font-weight-bold">Login</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <?php
                                if (isset($login_Customer)) {
                                    echo $login_Customer;
                                }
                                ?></div>

                        </div>
                    </div>
                    <div class="row p-3">
                        <label class="col-md-4 text-left control-label">Username</label>
                        <div class="col-md-8"><input type="text" id="txtName" class="form-control" name="email" /></div>
                    </div>

                    <div class="row p-3">
                        <label class="col-md-4 text-left control-label">Password</label>
                        <div class="col-md-8"><input type="password" id="txtPass" class="form-control" name="password" /></div>
                    </div>

                    <div class="row p-3">
                        <div class="col-md-12 text-center">
                            <button type="submit" name="login" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" onclick="Location :javascript:history.back();" class="btn btn-primary">Exit <i class="fas fa-sign-out-alt"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8 ">
        <div class="border border-primary rounded bg-light">
            <form class="mx-5" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title font-weight-bold">Đăng ký tài khoản</div>
                    </div>
                    <div class="col-md-12">
                        <div class="">
                            <?php
                            if (isset($insertCustomer)) {
                                echo $insertCustomer;
                            }
                            ?></div>

                    </div>
                </div>
                <div class="form-row pt-2">

                    <div class="form-group col-md-6 ">
                        <label for="inputEmail4">Họ tên</label>
                        <input type="text" class="form-control" name="name" id="inputEmail4">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" id="inputPassword4">
                    </div>

                </div>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" name="email" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" name="password" id="inputPassword4">
                    </div>

                </div>
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St">
                    </div>

                </div>
                <div class="mb-2">
                    <button type="submit" name="submit" class="btn btn-primary">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>