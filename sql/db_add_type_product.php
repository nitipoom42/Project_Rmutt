<?php

require_once("connect.php");

if (isset($_POST['Add_Type_Product'])) {

    $data_type = [
        'IMG_Type_Product' => $_FILES['IMG_Type_Product']['name'],
        'NAME_Type_Product' => $_POST['NAME_Type_Product'],
        'Status_Type' => 1

    ];

    // เอาไฟล์รูปลงเครื่อง
    $IMG_Porduct = $_FILES['IMG_Type_Product']['name'];
    $temp = '../Asset/img_type_product/' . $IMG_Porduct;
    if (move_uploaded_file($_FILES['IMG_Type_Product']['tmp_name'], $temp)) {
    }
    $sql_type = "INSERT INTO type_product (IMG_Type_Product,INFO_Type_Product,Status_Type) VALUES (:IMG_Type_Product,:NAME_Type_Product,:Status_Type)";
    $stmt_type = $conn->prepare($sql_type);
    $stmt_type->execute($data_type);
    $_SESSION['add_type'] = 1;
    Header("Location:../Admin/type_product.php");
}
