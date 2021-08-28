<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php') ?>

<!-- เพิ่มข้อมูล -->
<?php
if (isset($_POST['Add_bank'])) {
    $data_bank = [
        'IMG_bank' => $_FILES['IMG_bank']['name'],
        'NAME_bank' => $_POST['NAME_bank'],
        'NUM_bank' => $_POST['NUM_bank'],
    ];


    // เอาไฟล์รูปลงเครื่อง
    $IMG_bank = $_FILES['IMG_bank']['name'];
    $temp = '../Asset/img_bank/' . $IMG_bank;
    if (move_uploaded_file($_FILES['IMG_bank']['tmp_name'], $temp)) {

        // เอาข้อมูลเพิ่มลงไปในฐานข้อมูล
        try {
            $sql = "INSERT INTO bank (IMG_bank,NAME_bank,NUM_bank)
            VALUES (:IMG_bank,:NAME_bank,:NUM_bank)";
            $stmt = $conn->prepare($sql);
            $stmt->execute($data_bank);
            Header("Location:../Admin/add_bank.php");
        } catch (PDOException $e) {
            echo "เพิ่มข้อมูลข้อมูลไม่สำเร็จ: " . $e->getMessage();
        }
    }
}
?>