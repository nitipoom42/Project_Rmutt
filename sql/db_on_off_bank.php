<?php
require_once('connect.php');


if (isset($_POST['Status_on'])) {
    $data_no = [
        'ID_bank' => $_POST['ID_bank'],
        'Status_Product' => 1
    ];
    $sql_bank_on = "UPDATE bank SET Status_Product=:Status_Product WHERE ID_bank=:ID_bank";
    $stmt_bank_on = $conn->prepare($sql_bank_on);
    $stmt_bank_on->execute($data_no);
    $_SESSION['status_bank'] = 1;
    Header("Location:../Admin/add_bank.php");
}

if (isset($_POST['Status_off'])) {
    $data_off = [
        'ID_bank' => $_POST['ID_bank'],
        'Status_Product' => 2
    ];
    $sql_bank_off = "UPDATE bank SET Status_Product=:Status_Product WHERE ID_bank=:ID_bank";
    $stmt_bank_off = $conn->prepare($sql_bank_off);
    $stmt_bank_off->execute($data_off);
    $_SESSION['status_bank'] = 1;
    Header("Location:../Admin/add_bank.php");
}
