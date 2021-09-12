<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<?php

@$data_member = [
    'ID_Member' => $_SESSION['ID_Member'],
];

$sql_cart = "SELECT *FROM cart as c
WHERE c.ID_Member = :ID_Member GROUP BY ID_Product";
$stmt_cart = $conn->prepare($sql_cart);
$stmt_cart->execute($data_member);
$result_cart = $stmt_cart->fetchAll(PDO::FETCH_ASSOC);

// นับจำนวนรายการ order


$sql_oder_count = "SELECT *FROM oder WHERE ID_Member =:ID_Member AND oder_status <3 ";
$stmt_oder_count = $conn->prepare($sql_oder_count);
$stmt_oder_count->execute($data_member);
$result_oder_count = $stmt_oder_count->fetchAll(PDO::FETCH_ASSOC);
?>


<?php
@$url .= $_SERVER['REQUEST_URI'];
@$url = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
?>

<div class="fixed-top bg-light justify-content-between ">
    <div class="row box_menu_top">
        <div class="col-6 col-md-2">
            <h1 class="bg-info mt-2 p-1 banner"> <a href="index.php"> ร้าน - น้องมายด์</a></h1>
        </div>
        <div class="col-1 col-md-5">
            <ul class="nav item_menu_top">
                <li class="nav-item mt-3 ms-5">
                    <a class="nav-link info_menu <?php if ($url == 'index.php') {
                                                        echo "bg_menu_active";
                                                    } ?>" href="index.php">หน้าแรก</a>
                </li>
                <li class="nav-item mt-3 ms-5">
                    <a class="nav-link info_menu <?php if ($url == 'member.php') {
                                                        echo "bg_menu_active";
                                                    } ?>" href="member.php">สมาชิก</a>
                </li>
                <li class="nav-item mt-3 ms-5">
                    <a class="nav-link info_menu <?php if ($url == 'history.php') {
                                                        echo "bg_menu_active";
                                                    } ?>" href="history.php">รายการสั่งซื้อ
                    </a>
                    <?php
                    if ($result_oder_count) { ?>
                        <div class="noti_oder translate-middle badge rounded-pill bg-danger">
                            <?php echo count($result_oder_count); ?>
                        </div>
                    <?php    } ?>

                </li>
                <li class="nav-item mt-3 ms-5">
                    <a class="nav-link info_menu <?php if ($url == 'payment.php') {
                                                        echo "bg_menu_active";
                                                    } ?>" href="payment.php">ช่องทางการชำระเงิน</a>
                </li>
            </ul>
        </div>
        <div class="col-5  col-md-5 text-end">
            <div class="banner_photo mt-3 me-4">
                <button type="button" id="test" class="btn btn-outline-success position-relative" data-bs-backdrop="false" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                    <i class="fas fa-shopping-cart"></i>
                    <!-- แสดงตัวเลขของสินค้าในตะกร้าสินค้า -->
                    <?php
                    if ($result_cart) { ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo count($result_cart); ?>
                        </span>
                    <?php    } ?>
                </button>
            </div>
        </div>
    </div>



</div>
<!-- ตะกร้าสินค้า -->
<div class="offcanvas offcanvas-end" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">ตะกร้าสินค้า</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div id="cart"></div>
</div>

<script>
    $(document).ready(function() {
        $('#cart').load('cart.php');
    });
</script>