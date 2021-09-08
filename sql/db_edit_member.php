<?php
// ต่อฐานข้อมูล 
require_once('connect.php');



if (isset($_POST['edit_member'])) {

    $data_edit_member = [
        'Name' => $_POST['Name'],
        'Lastname' => $_POST['Lastname'],
        'Tel' => $_POST['Tel'],
        'ID_Member' => $_POST['ID_Member']
    ];

    $sql_edit_member = "UPDATE member  SET Name=:Name ,Lastname=:Lastname ,Tel=:Tel
    WHERE ID_Member=:ID_Member";
    $stmt_edit_member = $conn->prepare($sql_edit_member);
    $stmt_edit_member->execute($data_edit_member);
    $_SESSION['edit_member'] = 1;
    Header("Location:../User/member.php");
}
