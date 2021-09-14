<?php

require_once("connect.php");

if (isset($_POST['edit_product'])) {

    $data_product = [
        'ID_Product_Promotion' => $_POST['ID_Product_Promotion'],
        'NAME_Product' => $_POST['NAME_Product'],
        'QTY_Product' => $_POST['QTY_Product'],
        'Status_Product' => $_POST['Status_Product']
    ];
    $sql_product = "UPDATE stock_promotion  SET NAME_Product=:NAME_Product,QTY_Product=:QTY_Product,Status_Product=:Status_Product
    WHERE ID_Product_Promotion=:ID_Product_Promotion";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->execute($data_product);
    $_SESSION['edit_product'] = 1;

    Header("Location:../Admin/stock_promotion.php");
}
