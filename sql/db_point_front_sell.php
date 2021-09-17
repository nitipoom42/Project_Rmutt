<?php require_once('connect.php') ?>
<?php
$data_member_point = [
    'Tel_member' => $_POST['Tel_member'],
];
$sql_member_point = "SELECT * FROM member WHERE Tel =:Tel_member";
$stmt_member_point = $conn->prepare($sql_member_point);
$stmt_member_point->execute($data_member_point);
$result_member_point = $stmt_member_point->fetch(PDO::FETCH_ASSOC);

$row_Tel = ($stmt_member_point->rowCount());


echo $row_Tel;
?>