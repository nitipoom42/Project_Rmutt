<?php
// ต่อฐานข้อมูล 
require_once('connect.php');


if (isset($_POST['admin_confirm_pay'])) {

    $data_pay = [
        'ID_Oder' => $_POST['ID_Oder'],
        'ID_Member' => $_POST['ID_Member'],
        'oder_status' => 2,
    ];
    $sql_oder = "UPDATE oder SET oder_status=:oder_status WHERE ID_Oder=:ID_Oder AND ID_Member=:ID_Member  ";
    $stmt_oder = $conn->prepare($sql_oder);
    $stmt_oder->execute($data_pay);
    Header("Location:../Admin/oder.php");
}
