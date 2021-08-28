<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<?php

$data_member = [
    'ID_Member' => $_SESSION['ID_Member'],
];

$sql_cart = "SELECT * ,SUM(c.QTY) as QTY FROM cart  as c
JOIN stock as s ON c.ID_Product=s.ID_Product
JOIN type_product as t ON s.TYPE_Product = t.ID_Type_Product
WHERE c.ID_Member = :ID_Member
GROUP BY s.ID_Product;";
$stmt_cart = $conn->prepare($sql_cart);
$stmt_cart->execute($data_member);
$result_cart = $stmt_cart->fetchAll(PDO::FETCH_ASSOC);
?>



<?php
if (isset($_GET['ID_Product_minus'])) {

    $data_plus = [
        'ID_Product_minus' => $_GET['ID_Product_minus'],
        'QTY' => 1,
    ];

    // result($data_plus);
    $sql_plus = "UPDATE cart SET QTY=QTY-:QTY WHERE ID_Product=:ID_Product_minus LIMIT 1 ";
    $stmt_plus = $conn->prepare($sql_plus);
    $stmt_plus->execute($data_plus);
    Header("Location:../User/index.php");
}
?>


<div class="fixed-top bg-light d-flex justify-content-between ">
    <h1 class="bg-info mt-2 p-2 banner"> <a href="index.php"> ร้าน - น้องมายด์</a></h1>

    <div class="banner_photo mt-4 me-4">
        <button type="button" id="test" class="btn btn-primary position-relative" data-bs-backdrop="false" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
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