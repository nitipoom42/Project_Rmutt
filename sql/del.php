<?php require_once('connect.php') ?>

<!-- ลบข้อมูลสินค้าใน stock -->
<?php
if (isset($_GET['ID_Product'])) {
    $data_delete_Product = [
        'ID_Product' => $_GET['ID_Product']
    ];
    $delete_stmt_Product = ("DELETE FROM stock WHERE ID_Product=:ID_Product");
    $delete_stmt_Product = $conn->prepare($delete_stmt_Product);
    $delete_stmt_Product->execute($data_delete_Product);
    $_SESSION['dle_product'] = 1;
    Header("Location:../Admin/stock.php");
}
?>
<!-- ลบข้อมูลสินค้าใน stock -->
<?php
if (isset($_GET['ID_Product_Promotion'])) {
    $data_delete_Product_promotion = [
        'ID_Product_Promotion' => $_GET['ID_Product_Promotion']
    ];
    $delete_stmt_Product_promotion = ("DELETE FROM stock_promotion WHERE ID_Product_Promotion=:ID_Product_Promotion");
    $delete_stmt_Product_promotion = $conn->prepare($delete_stmt_Product_promotion);
    $delete_stmt_Product_promotion->execute($data_delete_Product_promotion);
    $_SESSION['dle_product'] = 1;
    Header("Location:../Admin/stock_promotion.php");
}
?>
<!-- ลบข้อมูลประเภทสินค้า -->
<?php
if (isset($_GET['ID_Type_Product'])) {
    $data_delete_Type = [
        'ID_Type_Product' => $_GET['ID_Type_Product']
    ];
    $delete_stmt_Type = ("DELETE FROM type_product WHERE ID_Type_Product=:ID_Type_Product");
    $delete_stmt_Type = $conn->prepare($delete_stmt_Type);
    $delete_stmt_Type->execute($data_delete_Type);
    Header("Location:../Admin/type_product.php");
}
?>

<!-- ลบข้อมูลสินค้าใน ตะกร้าสินค้า -->
<?php
if (isset($_GET['Cart_ID_Product'])) {

    // ตัด stock สินค้าเมื่อมีการหยิบลงตะกร้า
    $data_QTY = [
        'Cart_ID_Product' => $_GET['Cart_ID_Product'],
        'QTY' => $_GET['QTY']

    ];
    $sql_QTY = "UPDATE stock SET QTY_Product=QTY_Product+:QTY WHERE ID_Product=:Cart_ID_Product";
    $stmt_QTY = $conn->prepare($sql_QTY);
    $stmt_QTY->execute($data_QTY);

    // ตัด potin ของสมาชิก
    $data_promotion = [
        'ID_Member' => $_SESSION['ID_Member'],
        'POINT_Product' => $_GET['POINT_Product']
    ];
    $sql_point = "UPDATE member SET Point=Point+:POINT_Product WHERE ID_Member=:ID_Member ";
    $stmt_point = $conn->prepare($sql_point);
    $stmt_point->execute($data_promotion);

    // ตัดสินค้าโปรโมชั่น
    // ตัด stock สินค้าเมื่อมีการหยิบลงตะกร้า
    $data_stock_promotion = [
        'Cart_ID_Product' => $_GET['Cart_ID_Product'],
        'QTY' => $_GET['QTY'],

    ];
    $sql_stock_promotion = "UPDATE stock_promotion SET QTY_Product=QTY_Product+:QTY WHERE ID_Product_Promotion=:Cart_ID_Product";
    $stmt_stock_promotion = $conn->prepare($sql_stock_promotion);
    $stmt_stock_promotion->execute($data_stock_promotion);

    // ลบสินค้าออกจากตะกร้าสินค้า
    $data_delete_Product = [
        'Cart_ID_Product' => $_GET['Cart_ID_Product']
    ];
    $delete_stmt_Product = ("DELETE FROM cart WHERE ID_Product=:Cart_ID_Product");
    $delete_stmt_Product = $conn->prepare($delete_stmt_Product);
    $delete_stmt_Product->execute($data_delete_Product);
    Header("Location:../User/index.php");
}



?>

<!-- ลบข้อมูล bank -->
<?php
if (isset($_GET['ID_bank'])) {
    $data = [
        'ID_bank' => $_GET['ID_bank']
    ];
    $sql = ("DELETE FROM bank WHERE ID_bank=:ID_bank");
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    Header("Location:../Admin/add_bank.php");
}
?>
<!-- ลบข้อมูล Banner -->
<?php
if (isset($_GET['ID_Banner'])) {
    $data_banner = [
        'ID_Banner' => $_GET['ID_Banner']
    ];
    $sql_banner = ("DELETE FROM banner WHERE ID_Banner=:ID_Banner");
    $stmt_banner = $conn->prepare($sql_banner);
    $stmt_banner->execute($data_banner);
    Header("Location:../Admin/banner_promotion.php");
}
?>