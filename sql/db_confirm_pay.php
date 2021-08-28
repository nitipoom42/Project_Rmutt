<?php
// ต่อฐานข้อมูล 
require_once('connect.php');


if (isset($_POST['confirm_pay'])) {

    $data_pay = [
        'ID_Oder' => $_POST['ID_Oder'],
        'NAME_bank' => $_POST['NAME_bank'],
        'ID_Member' => $_SESSION['ID_Member'],
        'IMG_Pay' => $_FILES['IMG_Pay']['name']
    ];

    $IMG_Porduct = $_FILES['IMG_Pay']['name'];
    $temp = '../Asset/img_pay/' . $IMG_Porduct;
    if (move_uploaded_file($_FILES['IMG_Pay']['tmp_name'], $temp)) {

        $sql_pay = "INSERT INTO pay (ID_Oder,ID_Member,IMG_Pay,NAME_bank) VALUES (:ID_Oder,:ID_Member,:IMG_Pay,:NAME_bank)";
        $stmt_pay = $conn->prepare($sql_pay);
        $stmt_pay->execute($data_pay);
    }
    $data_oder = [
        'id_o' => $_POST['ID_Oder'],
        'id_m' => $_SESSION['ID_Member'],
        'oder_status' => 1
    ];
    $sql_oder = "UPDATE oder  SET oder_status=:oder_status WHERE ID_Member=:id_m AND ID_Oder=:id_o";
    $stmt_oder = $conn->prepare($sql_oder);
    $stmt_oder->execute($data_oder);

    $data_m = [
        'ID_Member' => $_SESSION['ID_Member'],
        'Point' => $_POST['Point']
    ];

    $sql_member = "UPDATE  member SET Point=Point+:Point WHERE ID_Member=:ID_Member";
    $stmt_member = $conn->prepare($sql_member);
    $stmt_member->execute($data_m);

    $_SESSION['status_onti'] = 1;
    Header("Location:../User/history.php");
}
