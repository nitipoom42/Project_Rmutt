<?php
require_once('connect.php');

$sql_time_promotion = "SELECT * FROM stock_promotion";
$stmt_time_promotion = $conn->prepare($sql_time_promotion);
$stmt_time_promotion->execute();
$result_time_promotion = $stmt_time_promotion->fetchAll(PDO::FETCH_ASSOC);

$date_now = date("Y-m-d");

$date_now;

foreach ($result_time_promotion as $row_time_promotion) {

    if ($date_now > $row_time_promotion['date_out']) {

        $data_out_promotion = [
            'ID_Product_Promotion' => $row_time_promotion['ID_Product_Promotion']
        ];
        $sql_time_promotion_del = "DELETE FROM stock_promotion WHERE ID_Product_Promotion=:ID_Product_Promotion";
        $stmt_time_promotion_del = $conn->prepare($sql_time_promotion_del);
        $stmt_time_promotion_del->execute($data_out_promotion);
    }
}
