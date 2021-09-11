<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php') ?>

<!-- เพิ่มข้อมูล -->
<?php
if (isset($_POST['Add_Product'])) {
    $data_Product = [
        'IMG_Product' => $_FILES['IMG_Product']['name'],
        'ID_Product' => $_POST['ID_Product'],
        'NAME_Product' => $_POST['NAME_Product'],
        'Cost_PRICE_Product' => $_POST['Cost_PRICE_Product'],
        'PRICE_Product' => $_POST['PRICE_Product'],
        'QTY_Product' => $_POST['QTY_Product'],
        'Type_Product' => $_POST['Type_Product'],
        'Status_Product' => 1,
    ];
    // เอาไฟล์รูปลงเครื่อง
    $IMG_Porduct = $_FILES['IMG_Product']['name'];
    $temp = '../Asset/img/' . $IMG_Porduct;
    if (move_uploaded_file($_FILES['IMG_Product']['tmp_name'], $temp)) {

        // เอาข้อมูลเพิ่มลงไปในฐานข้อมูล
        try {
            $sql_Add_Product = "INSERT INTO stock (IMG_Product,NAME_Product,ID_Product,Cost_PRICE_Product,PRICE_Product,QTY_Product,Type_Product,Status_Product)
            VALUES (:IMG_Product,:NAME_Product,:ID_Product,:Cost_PRICE_Product,:PRICE_Product,:QTY_Product,:Type_Product,:Status_Product)";
            $stmt_Add_Product = $conn->prepare($sql_Add_Product);
            $stmt_Add_Product->execute($data_Product);
            $_SESSION['add_product'] = 1;
            Header("Location:../Admin/add_product.php");
        } catch (PDOException $e) {
            echo "เพิ่มข้อมูลข้อมูลไม่สำเร็จ: " . $e->getMessage();
        }
    }
}
?>