<?php
// ต่อฐานข้อมูล 
require_once('connect.php');
?>




<?php
$data_member = [
    'Tel' => $_POST['Tel'],
    'point' => $_POST['point'],
];
$sql_member_sell = "UPDATE member SET Point=Point+:point WHERE Tel=:Tel";
$smtm_member_sell = $conn->prepare($sql_member_sell);
$smtm_member_sell->execute($data_member);


$date = new DateTime();
?>
<?php
$sql = "SELECT * FROM oder";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
$data_oder = [
    'ID_Member' => $_SESSION['ID_Member'],
    'oder_status' => 4,
];
// insert ข้อมูลลงในตาราง oder โดยเลือกข้อมูล ID_Product,ID_Member,QTY จากตาราง cart โดยต้องมี ID_Member ที่ตรงกัน
$sql_oder = "INSERT INTO oder (ID_Member,oder_status) VALUES (:ID_Member,:oder_status)";
$stmt_oder = $conn->prepare($sql_oder);
$stmt_oder->execute($data_oder);
$data_oder1 = [
    'ID_Member1' => $_SESSION['ID_Member'],
    'last_ID' => $conn->lastInsertId(),
];

// เพิ่มข้อมูลลงในตาราง oder_detail
$sql_oder = "INSERT INTO oder_detail (ID_Oder,ID_Product,QTY)
        SELECT :last_ID,c.ID_Product,c.QTY FROM oder  as o
        JOIN member as m ON o.ID_Member = m.ID_Member
        JOIN cart as c ON o.ID_Member = c.ID_Member
        WHERE o.ID_Oder = :last_ID";
$stmt_oder = $conn->prepare($sql_oder);
$stmt_oder->execute($data_oder1);




// // ลบข้อมูลออกจากตะกร้า -->
$data_member = [
    'ID_Member' => $_SESSION['ID_Member']
];
$sql_oder_del = ("DELETE FROM cart WHERE ID_Member=:ID_Member");
$stmt_oder_del = $conn->prepare($sql_oder_del);
$stmt_oder_del->execute($data_member);

?>
