<?php
// gọi file adminlogin
include '../class/admin.php';
?>
<?php
$class = new admin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $adminUser = $_POST['txtUserName'];
    $adminPass = $_POST['txtUserPass'];

    $login_check = $class->longin_admin($adminUser, $adminPass); // hàm check User and Pass khi submit lên

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login2</title>
    <link href="../css/login2.css" type="text/css" rel="stylesheet" />
    <link href="../css/bootstrap.css" type="text/css" rel="stylesheet" />
    <link href="../css/bootstrap-grid.css" type="text/css" rel="stylesheet" />
    <script src="../js/login.js" language="javascript"></script>

</head>

<body>
    <div class="container-sm">
        <div class="row gx-5">
            <div class="col-md-6 offset-md-3">
                <form name="frmLogin" action="" method="">
                    <div class="loginview">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="title text-center">Login</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <?php
                            if (isset($login_check)) {
                                echo $login_check;
                            }
                            ?></div>
                            
                            </div>
                        </div>
                        <div class="row p-3">
                            <label class="col-md-4 text-right control-label">Username</label>
                            <div class="col-md-6"><input type="text" id="txtName" class="form-control" name="txtUserName" /></div>
                        </div>

                        <div class="row p-3">
                            <label class="col-md-4 text-right control-label">Password</label>
                            <div class="col-md-6"><input type="password" id="txtPass" class="form-control" name="txtUserPass" /></div>
                        </div>

                        <div class="row p-3">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-primary" onclick="login(this.form)"><i class="fas fa-sign-in-alt"></i> Sign in</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-primary">Exit <i class="fas fa-sign-out-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>