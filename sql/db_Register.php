<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php') ?>

<!-- เพิ่มข้อมูลในตาราง member -->
<?php
if (isset($_POST['Register'])) {
    $data_Register = [
        'IMG_User' => $_FILES['IMG_User']['name'],
        'User' => $_POST['User'],
        'Pass' => $_POST['Pass'],
        'Name' => $_POST['Name'],
        'Lastname' => $_POST['Lastname'],
        'Tel' => $_POST['Tel']
    ];
    // เอาไฟล์รูปลงเครื่อง
    $IMG_User = $_FILES['IMG_User']['name'];
    $temp = '../Asset/img_member/' . $IMG_User;
    if (move_uploaded_file($_FILES['IMG_User']['tmp_name'], $temp)) {

        // เอาข้อมูลเพิ่มลงไปในฐานข้อมูล
        try {
            $sql_Register = "INSERT INTO member (IMG_User,User,Pass,Name,Lastname,Tel)
            VALUES (:IMG_User,:User,:Pass,:Name,:Lastname,:Tel)";
            $stmt_Register = $conn->prepare($sql_Register);
            $stmt_Register->execute($data_Register);
            Header("Location:../User/login.php");
        } catch (PDOException $e) {
            echo "เพิ่มข้อมูลข้อมูลไม่สำเร็จ: " . $e->getMessage();
        }
    }
}
?>