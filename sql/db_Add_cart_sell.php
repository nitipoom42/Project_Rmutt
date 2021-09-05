<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php') ?>

<?php
$data_sell = [
    'ID_Product' => $_POST['ID_Product'],
];
$sql_sell = "SELECT * FROM stock WHERE ID_Product =:ID_Product";
$stmt_sell = $conn->prepare($sql_sell);
$stmt_sell->execute($data_sell);
$result_sell = $stmt_sell->fetchAll(PDO::FETCH_ASSOC);

if ($stmt_sell->rowCount() == 1) {
    // เพิ่มของลงตะกร้า    
    $data_cart = [
        'ID_Product' => $_POST['ID_Product'],
        'ID_Member' => $_SESSION['ID_Member'],
        'QTY' => 1
    ];
    $sql_cart = "INSERT INTO cart (ID_Product,ID_Member,QTY) VALUES (:ID_Product,:ID_Member,:QTY)";
    $stmt_cart = $conn->prepare($sql_cart);
    $stmt_cart->execute($data_cart);

    $data_QTY = [
        'ID_Product' => $_POST['ID_Product'],
        'QTY' => 1
    ];
    $sql_QTY = "UPDATE stock SET QTY_Product=QTY_Product-:QTY WHERE ID_Product=:ID_Product ";
    $stmt_QTY = $conn->prepare($sql_QTY);
    $stmt_QTY->execute($data_QTY);
}
if ($stmt_sell->rowCount() == 0) {
    $_SESSION['scan_false'] = 1;
}

?>