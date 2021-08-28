<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>
<?php

$sql_oder = "SELECT * FROM oder_detail as od
JOIN oder as o ON od.ID_Oder = od.ID_Oder
JOIN stock as s ON s.ID_Product = od.ID_Product
WHERE o.oder_status=0 OR o.oder_status=1 OR o.oder_status=2
GROUP BY o.ID_Oder";
$stmt_oder = $conn->prepare($sql_oder);
$stmt_oder->execute();
$result_oder = $stmt_oder->fetchAll(PDO::FETCH_ASSOC);

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

<div id="content">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">ร้านของมายด์</div>
        </a>

        <!-- Heading -->
        <div class="sidebar-heading">
            เมนู
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="oder.php">
                <i class="fas fa-cart-arrow-down"></i>
                <span>รายการสั่งซื้อ
                    <?php
                    if ($result_oder) { ?>
                        <p class="btn btn-danger btn-sm rounded"> <?php echo count($result_oder); ?></p>

                    <?php    }
                    ?>
                </span>

            </a>
            <a class="nav-link collapsed" href="add_product.php">
                <i class="far fa-plus-square"></i>
                <span>เพิ่มสินค้า</span>
            </a>
            <a class="nav-link collapsed" href="stock.php">
                <i class="fas fa-layer-group"></i>
                <span>สต๊อกสินค้า</span>
            </a>
            <a class="nav-link collapsed" href="type_product.php">
                <i class="fas fa-cubes"></i>
                <span>ประเภทสินค้า</span>
            </a>
            <a class="nav-link collapsed" href="add_bank.php">
                <i class="fas fa-money-bill-wave"></i>
                <span>ธนาคาร</span>
            </a>


        </li>
    </ul>
    <!-- End of Sidebar -->


</div>