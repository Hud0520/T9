<?php
include '../lib/session.php';
Session::checkSession();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Content Management System</title>
    <link href="../css/layout.css" type="text/css" rel="stylesheet" />
    <link href="../css/bootstrap.css" type="text/css" rel="stylesheet" />
    <link href="../css/bootstrap-grid.css" type="text/css" rel="stylesheet" />
    <script src="" language="javascript"></script>
    <script language="javascript" src="ckeditor/ckeditor.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="logo bg-primary text-center text-white ">Logo</div>
            </div>
            <div class="col-md-8">
                <div class="acc text-center bg-info align-middle text-white">
                    <div class="row pt-2">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-6">
                            <h4>Xin chào Admin</h4>
                            <?php
                            if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                                Session::destroy();
                            }
                            ?>
                        </div>
                        <div class="col-md-3">
                            <a href="?action=logout">
                                <span>
                                    <i class="fas fa-sign-out-alt"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
        <div class="col-md-12">
            <nav class=" navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="index.php">Dash board<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="orderlist.php">Đơn hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="../index.php">Website</a>
                        </li>
                    </ul>
                </div></div>
            </nav>
        </div>
        <div class="row mt-3">
            <div class="col-md-2">
                <div class="menu">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Danh mục
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <a href="catlist.php">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Danh sách danh mục
                                    </button></a>
                                    <a href="catadd.php">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Thêm danh mục
                                    </button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Sản phẩm
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                <a href="productadd.php">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Thêm mới sản phẩm
                                    </button></a>
                                    <a href="productlist.php">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Danh sách sản phẩm
                                    </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>