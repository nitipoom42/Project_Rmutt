<?php
require_once('connect.php');


$sql_oder_time = "SELECT * FROM oder as o
INNER JOIN  oder_detail as od ON o.ID_Oder = od.ID_Oder WHERE oder_status = 0";
$stmt_oder_time = $conn->prepare($sql_oder_time);
$stmt_oder_time->execute();
$result_oder_time = $stmt_oder_time->fetchAll(PDO::FETCH_ASSOC);

foreach ($result_oder_time as $row_oder_time) {

    $row_oder_time['Oder_date'];
    echo $date_order =  date("H:i:s", strtotime($row_oder_time['Oder_date'], 10));




    exit();
    if ($date_order > $Time_out) {

        $data_Product_time = [
            'ID_Product' => $row_oder_time['ID_Product'],
            'QTY' => $row_oder_time['QTY'],
        ];
        $sql_update_product_time = "UPDATE stock SET QTY_Product=QTY_Product+:QTY WHERE ID_Product=:ID_Product";
        $stmt_update_product_time = $conn->prepare($sql_update_product_time);
        $stmt_update_product_time->execute($data_Product_time);

        $sql_update_product_promotion_time = "UPDATE stock_promotion SET QTY_Product=QTY_Product+:QTY WHERE ID_Product_Promotion=:ID_Product";
        $stmt_update_product_promotion_time = $conn->prepare($sql_update_product_promotion_time);
        $stmt_update_product_promotion_time->execute($data_Product_time);

        $data_Oder_time = [
            'ID_Oder' => $row_oder_time['ID_Oder'],
        ];
        // ลบข้อมูลตาราง oder_detail
        $sql_cancel_oder_detail_time = "DELETE FROM oder_detail WHERE ID_Oder=:ID_Oder";
        $stmt_cancel_oder_detail_time = $conn->prepare($sql_cancel_oder_detail_time);
        $stmt_cancel_oder_detail_time->execute($data_Oder_time);
        // ลบข้อมูลตาราง ตาราง oder
        $sql_cancel_oder_time = "DELETE FROM oder WHERE ID_Oder=:ID_Oder";
        $stmt_cancel_oder_time = $conn->prepare($sql_cancel_oder_time);
        $stmt_cancel_oder_time->execute($data_Oder_time);
    }
}
