<?php
include 'lib/session.php';
Session::init();
?>
<?php

include 'lib/database.php';

spl_autoload_register(function ($class) {
    include_once "class/" . $class . ".php";
});
$db = new Database();
$ct = new cart();
$us = new user();
$cs = new customer();
$cat = new category();
$product = new product();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shop</title>
    <link href="css/layout.css" type="text/css" rel="stylesheet" />
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" />
    <link href="css/bootstrap-grid.css" type="text/css" rel="stylesheet" />
    <script src="js/main.js" language="javascript"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bg-info">
                <div class="p-2 text-center  align-middle text-white">
                    <div class="row pt-2 my-2">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <h3>WE ARE T9</h3>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <nav class=" col-md-12 navbar navbar-expand-lg navbar-light  bg-light ">
                <a class="navbar-brand" href="#">LoGo</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class=" collapse navbar-collapse p-2" id="navbarSupportedContent ">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="index.php">Trang chủ<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="product.php">Sản phẩm</a>
                        </li>
                        <?php
                        $login_check = Session::get('customer_login');
                        if ($login_check == false) {
                            echo '';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link font-weight-bold" href="order.php">Đơn hàng</a></li>';
                        }
                        if ($login_check == false) {
                            echo '';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link font-weight-bold" href="info.php">Thông tin</a></li>';
                        }
                        ?>

                    </ul>
                    <div class="text-right">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" onclick="javascript:location.href='cart.php'" class="btn btn-secondary"><i class="fas fa-shopping-cart"></i></button>
                            <?php
                            $check_cart = $ct->check_cart();
                            if ($check_cart) {
                                $sum = Session::get("sum");
                                $qty = Session::get("qty");
                                echo '<button type="button" onclick="javascript:location.href=\'cart.php\'" class="btn btn-outline-dark px-4">'.$sum.' VND  SL:' .$qty .'</button>';
                            } else {
                                echo '<button type="button" onclick="javascript:location.href=\'cart.php\'" class="btn btn-outline-dark px-4">Emtyp</button>';
                            }
                            ?>
                        </div>
                        <?php
                        if (isset($_GET['customer_id'])) {
                            $customer_id = $_GET['customer_id'];
                            $delCart = $ct->del_all_data_cart();

                            Session::destroy();
                        }
                        ?>
                        <?php
                        $login_check = Session::get('customer_login');
                        if ($login_check == false) {
                            echo '<a href="login.php"><button type="button" class="btn btn-primary">Login</button></a>';
                        } else {
                            echo '<a href="?customer_id=' . Session::get('customer_id') . ' "><button type="button" class="btn btn-primary">Logout</button></a></div>';
                        }
                        ?>
                    </div>
                </div>
            </nav>
        </div>