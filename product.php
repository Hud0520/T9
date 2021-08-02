<?php include('main/header.php'); ?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    $show=false;
    $id=-1;
} else {
    $id = $_GET['catid']; // Lấy catid trên host
    $show = $product->get_product($id); // hàm check delete Name khi submit lên
}
?>
<div class="row">
    <div class="col-md-2 mt-2">
        <div class="list-group">
            <?php
            $show_cat = $cat->show_category();
            if ($show_cat) {
                $i = 0;
                while ($result = $show_cat->fetch_assoc()) {
                    $i++;
             if ($result['MaChungLoaiSP'] == $id){?>
                            <a href="product.php?catid=<?php echo $result['MaChungLoaiSP'] ?>" class="list-group-item list-group-item-action active"><?php echo $result['TenChungLoaiSP'] ;?></a>
                        <?php }else{?>
                            <a href="product.php?catid=<?php echo $result['MaChungLoaiSP'] ?>" class="list-group-item list-group-item-action"><?php echo $result['TenChungLoaiSP'] ;?></a>
            <?php
                        }
                }
            }
            ?>
        </div>
    </div>
    <div class="col-md-10">
        <div class="row ">
            <?php if ($show) {
                while ($rs = $show->fetch_assoc()) {
                ?>
                    <div class="col-md-3 mt-2 card-deck">
                        <div class="card">
                            <div class="card-img-top img"></div>
                            <div class="card-body">
                                <h5 class="card-title text-primary"><?php echo $rs['TenSanPham']?></h5>
                                <p class="card-text">Giá bán: <?php echo $rs['GiaBan']?>&nbsp;<i class="fas fa-money-check-alt"></i></p>
                            </div>
                            <a href="detail.php?proid=<?php echo $rs['MaSanPham'] ?>">
                                <div class="card-footer bg-info">
                                    <small class="text-light">Xem chi tiết</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                        }
                    }else{?>
                        <div class=" mt-2 col-md-12 p-2 bg-warning">Danh sách rỗng</div><?php
                    }
                ?>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>