<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<?php
@$url .= $_SERVER['REQUEST_URI'];
@$url = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
?>
<?php

$sql_oder = "SELECT * FROM oder_detail as od
JOIN oder as o ON od.ID_Oder = od.ID_Oder
JOIN stock as s ON s.ID_Product = od.ID_Product
WHERE o.oder_status=1 OR o.oder_status=2
GROUP BY o.ID_Oder";
$stmt_oder = $conn->prepare($sql_oder);
$stmt_oder->execute();
$result_oder = $stmt_oder->fetchAll(PDO::FETCH_ASSOC);


// นับสินค้าที่ใก้ลหมด
$sql_oder_out_stock = "SELECT * FROM stock 
WHERE QTY_Product < 20";
$stmt_oder_out_stock = $conn->prepare($sql_oder_out_stock);
$stmt_oder_out_stock->execute();
$result_oder_out_stock = $stmt_oder_out_stock->fetchAll(PDO::FETCH_ASSOC);

?>
<?php
if (@$_SESSION['status_onti'] == 1) {
    echo "<script>
        Swal.fire({
            icon: 'warning',
          title:'มีรายการสั่งซื้อเข้ามาใหม่',
          confirmButtonText: `ยืนยัน`,
          confirmButtonColor: '#d33',
          })
        </script>";
    $_SESSION['status_onti'] = 0;
}
?>
<div id="content ">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion " id="accordionSidebar ">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center " href="index.php">
            <div class="sidebar-brand-icon rotate-n-15 ">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">ร้านของมายด์</div>
        </a>

        <!-- Heading -->
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link  collapsed <?php if ($url == 'menu.php') {
                                                echo "bg_menu_admin";
                                            } ?>" href="index.php">
                <i class="fas fa-file-invoice ms-1 me-2"></i>
                <span> รายงานยอดขาย</span>
            </a>
            <a class="nav-link collapsed <?php if ($url == 'oder.php') {
                                                echo "bg_menu_admin";
                                            } ?>" href="oder.php">
                <i class="fas fa-cart-arrow-down"></i>
                <span>รายการสั่งซื้อ
                    <?php
                    if ($result_oder) { ?>
                        <p class="btn btn-danger btn-sm rounded"> <?php echo count($result_oder); ?></p>
                    <?php    }
                    ?>
                </span>
            </a>
            <a class="nav-link collapsed <?php if ($url == 'sell.php') {
                                                echo "bg_menu_admin";
                                            } ?>" href="sell.php">
                <i class="far fa-plus-square"></i>
                <span>หน้าร้าน </span>
            </a>
            <hr>

            <a class="nav-link collapsed <?php if ($url == 'add_product.php') {
                                                echo "bg_menu_admin";
                                            } ?>" href="add_product.php">
                <i class="far fa-plus-square"></i>
                <span>เพิ่มสินค้า</span>
            </a>
            <a class="nav-link collapsed <?php if ($url == 'add_product_promotion.php') {
                                                echo "bg_menu_admin";
                                            } ?>" href="add_product_promotion.php">
                <i class="fab fa-product-hunt"></i>
                <span>เพิ่มสินค้าโปรโมชั่น</span>
            </a>
            <a class="nav-link collapsed <?php if ($url == 'banner_promotion.php') {
                                                echo "bg_menu_admin";
                                            } ?>" href="banner_promotion.php">
                <i class="far fa-images"></i>
                <span>แบนเนอร์โปรโมชั่น</span>
            </a>
            <a class="nav-link collapsed " data-bs-toggle="collapse" href="#collapseExample">
                <i class="fas fa-cubes"></i>
                <span>สต๊อกสินค้า

                    <p class="btn btn-danger btn-sm rounded"><?php echo  $stmt_oder_out_stock->rowCount(); ?></p>

                </span>
            </a>

            <div class="collapse" id="collapseExample">
                <a class="nav-link collapsed" href="stock.php">
                    <i class="far fa-plus-square"></i>
                    <span>สินค้าทั่วไป <p class="btn btn-danger btn-sm rounded"><?php echo  $stmt_oder_out_stock->rowCount(); ?></p></span>
                </a>
                <a class="nav-link collapsed" href="stock_promotion.php">
                    <i class="far fa-plus-square"></i>
                    <span>สินค้าโปรโมชั่น</span>
                </a>
            </div>
            <a class="nav-link collapsed <?php if ($url == 'type_product.php') {
                                                echo "bg_menu_admin";
                                            } ?>" href="type_product.php">
                <i class="fas fa-cubes"></i>
                <span>ประเภทสินค้า</span>
            </a>
            <a class="nav-link collapsed <?php if ($url == 'add_bank.php') {
                                                echo "bg_menu_admin";
                                            } ?>" href="add_bank.php">
                <i class="fas fa-money-bill-wave"></i>
                <span>ธนาคาร</span>
            </a>
            <a class="nav-link collapsed" href="../sql/db_Logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>ออกจากระบบ</span>
            </a>
        </li>
    </ul>
    <!-- End of Sidebar -->


</div>