<?php
require_once('connect.php');

$sql_time_banner = "SELECT * FROM banner";
$stmt_time_banner = $conn->prepare($sql_time_banner);
$stmt_time_banner->execute();
$result_time_banner = $stmt_time_banner->fetchAll(PDO::FETCH_ASSOC);

$date_now = date("Y-m-d");

foreach ($result_time_banner as $row_time_banner) {

    if ($date_now > $row_time_banner['date_banber']) {

        $data_out_banner = [
            'ID_Banner' => $row_time_banner['ID_Banner']
        ];
        $sql_time_banner_del = "DELETE FROM banner WHERE ID_Banner=:ID_Banner";
        $stmt_time_banner_del = $conn->prepare($sql_time_banner_del);
        $stmt_time_banner_del->execute($data_out_banner);
    }
}
