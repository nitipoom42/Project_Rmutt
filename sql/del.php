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