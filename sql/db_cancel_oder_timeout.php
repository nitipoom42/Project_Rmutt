<?php
require_once('connect.php');

$sql_oder_time_default = "SELECT * FROM oder";
$stmt_oder_time_default  = $conn->prepare($sql_oder_time_default);
$stmt_oder_time_default->execute();
$result_oder_time_default  = $stmt_oder_time_default->fetchAll(PDO::FETCH_ASSOC);

foreach ($result_oder_time_default as $row_time_default) {
    $data = [
        'ID_Oder' => $row_time_default['ID_Oder'],
    ];
    $sql_oder_time = "SELECT * FROM oder as o
    INNER JOIN  oder_detail as od ON o.ID_Oder = od.ID_Oder WHERE oder_status = 0 AND o.ID_Oder=:ID_Oder";
    $stmt_oder_time = $conn->prepare($sql_oder_time);
    $stmt_oder_time->execute($data);
    $result_oder_time = $stmt_oder_time->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result_oder_time as $row_oder_time) {
        $row_oder_time['Oder_date'];
        $date_order_default = strtotime($row_oder_time['Oder_date'], 10);
        $date_order_result = date("H:i:s", $date_order_default);
        $Time_out = date("H:i:s", strtotime('+30 minutes', $date_order_default));
        $date_now_oder = date("H:i:s");

        if ($date_now_oder > $Time_out) {
            echo "เกินเวลา";

            $data_ID_Oder = [
                'ID_Oder' => $row_time_default['ID_Oder'],
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
        }
    }
}
