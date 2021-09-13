<?php

require_once("connect.php");

if (isset($_POST['edit_type_product'])) {

    $data_type = [
        'ID_Type_Product' => $_POST['ID_Type_Product'],
        'INFO_Type_Product' => $_POST['INFO_Type_Product'],
        'Status_Product' => $_POST['Status_Product']
    ];

    $sql_type = "UPDATE type_product  SET INFO_Type_Product=:INFO_Type_Product,Status_Type=:Status_Product WHERE ID_Type_Product=:ID_Type_Product";
    $stmt_type = $conn->prepare($sql_type);
    $stmt_type->execute($data_type);
    $_SESSION['edit_type'] = 1;
    Header("Location:../Admin/type_product.php");
}
