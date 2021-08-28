<?php

require_once("connect.php");

if (isset($_POST['Add_Type_Product'])) {

    $data_type = [
        'NAME_Type_Product' => $_POST['NAME_Type_Product'],
    ];

    $sql_type = "INSERT INTO type_product (INFO_Type_Product) VALUES (:NAME_Type_Product)";
    $stmt_type = $conn->prepare($sql_type);
    $stmt_type->execute($data_type);
    $_SESSION['add_type'] = 1;
    Header("Location:../Admin/type_product.php");
}
