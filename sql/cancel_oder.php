<?php
require_once('connect.php');

if (isset($_GET['cancel_oder'])) {

    $data_ID_Oder = [
        'ID_Oder' => $_GET['cancel_oder'],
    ];

    $sql_oder = "SELECT * FROM oder as o
    INNER JOIN  oder_detail as od ON o.ID_Oder = od.ID_Oder
    WHERE od.ID_Oder=:ID_Oder";
    $stmt_oder = $conn->prepare($sql_oder);
    $stmt_oder->execute($data_ID_Oder);
    $result_oder = $stmt_oder->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result_oder as $row_oder) {
        $data_Product = [
            'ID_Product' => $row_oder['ID_Product'],
            'QTY' => $row_oder['QTY'],
        ];
        $sql_update_product = "UPDATE stock SET QTY_Product=QTY_Product+:QTY WHERE ID_Product=:ID_Product";
        $stmt_update_product = $conn->prepare($sql_update_product);
        $stmt_update_product->execute($data_Product);

        $sql_update_product_promotion = "UPDATE stock_promotion SET QTY_Product=QTY_Product+:QTY WHERE ID_Product_Promotion=:ID_Product";
        $stmt_update_product_promotion = $conn->prepare($sql_update_product_promotion);
        $stmt_update_product_promotion->execute($data_Product);

        // ลบข้อมูลตาราง oder_detail
        $sql_cancel_oder_detail = "DELETE FROM oder_detail WHERE ID_Oder=:ID_Oder";
        $stmt_cancel_oder_detail = $conn->prepare($sql_cancel_oder_detail);
        $stmt_cancel_oder_detail->execute($data_ID_Oder);
        // ลบข้อมูลตาราง ตาราง oder
        $sql_cancel_oder = "DELETE FROM oder WHERE ID_Oder=:ID_Oder";
        $stmt_cancel_oder = $conn->prepare($sql_cancel_oder);
        $stmt_cancel_oder->execute($data_ID_Oder);
    }
    Header("Location:../User/history.php");
};
