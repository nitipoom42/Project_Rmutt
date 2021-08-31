<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php') ?>

<!-- เพิ่มข้อมูล -->
<?php
if (isset($_POST['Add_banner'])) {
    $data_banner = [
        'IMG_Banner' => $_FILES['IMG_Banner']['name'],
    ];
    // เอาไฟล์รูปลงเครื่อง
    $IMG_Banner = $_FILES['IMG_Banner']['name'];
    $temp = '../Asset/img_banner/' . $IMG_Banner;
    if (move_uploaded_file($_FILES['IMG_Banner']['tmp_name'], $temp)) {

        // เอาข้อมูลเพิ่มลงไปในฐานข้อมูล
        try {
            $sql = "INSERT INTO banner (IMG_Banner)
            VALUES (:IMG_Banner)";
            $stmt = $conn->prepare($sql);
            $stmt->execute($data_banner);
            Header("Location:../Admin/banner_promotion.php");
        } catch (PDOException $e) {
            echo "เพิ่มข้อมูลข้อมูลไม่สำเร็จ: " . $e->getMessage();
        }
    }
}
?>