<?php

require_once("connect.php");

if (isset($_POST['edit_product'])) {

    $data_product = [
        'ID_Product' => $_POST['ID_Product'],
        'NAME_Product' => $_POST['NAME_Product'],
        'PRICE_Product' => $_POST['PRICE_Product'],
        'QTY_Product' => $_POST['QTY_Product'],
        'Status_Product' => $_POST['Status_Product'],

    ];

    $sql_product = "UPDATE stock  SET NAME_Product=:NAME_Product,PRICE_Product=:PRICE_Product,QTY_Product=:QTY_Product,Status_Product=:Status_Product
    WHERE ID_Product=:ID_Product";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->execute($data_product);
    $_SESSION['edit_product'] = 1;

    Header("Location:../Admin/stock.php");
}
