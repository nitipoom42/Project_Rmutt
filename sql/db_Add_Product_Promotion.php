<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php') ?>

<!-- เพิ่มข้อมูล -->
<?php
if (isset($_POST['Add_Product_Promotion'])) {
    $data_Product = [
        'IMG_Product' => $_FILES['IMG_Product']['name'],
        'NAME_Product' => $_POST['NAME_Product'],
        'POINT_Product' => $_POST['POINT_Product'],
        'QTY_Product' => $_POST['QTY_Product'],
        'Type_Product' => $_POST['Type_Product'],
    ];
    // เอาไฟล์รูปลงเครื่อง
    $IMG_Porduct = $_FILES['IMG_Product']['name'];
    $temp = '../Asset/img_promotion/' . $IMG_Porduct;
    if (move_uploaded_file($_FILES['IMG_Product']['tmp_name'], $temp)) {

        // เอาข้อมูลเพิ่มลงไปในฐานข้อมูล
        try {
            $sql_Add_Product = "INSERT INTO stock_promotion (IMG_Product,NAME_Product,POINT_Product,QTY_Product,Type_Product)
            VALUES (:IMG_Product,:NAME_Product,:POINT_Product,:QTY_Product,:Type_Product)";
            $stmt_Add_Product = $conn->prepare($sql_Add_Product);
            $stmt_Add_Product->execute($data_Product);

            $_SESSION['add_product'] = 1;
            Header("Location:../Admin/add_Product_Promotion.php");
        } catch (PDOException $e) {
            echo "เพิ่มข้อมูลข้อมูลไม่สำเร็จ: " . $e->getMessage();
        }
    }
}
?>