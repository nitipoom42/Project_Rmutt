<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php') ?>

<?php

// เช็คก่อนว่า User ทำการlogin แล้วหรือยัง ถ้ายังก็ให้ทำการ login ก่อนถึงจะหยิบของลงตะกร้าได้
if (empty($_SESSION['User'])) {

    Header("Location:../User/login.php");
}
// เพิ่มของลงตะกร้า    
else if (isset($_POST['Add_Cart'])) {

    $data = [
        'ID_Product' => $_POST['ID_Product'],
    ];
    // result($data['QTY']);
    $sql = "SELECT * FROM stock WHERE ID_Product =:ID_Product AND Status_Product = 1";
    $smtm = $conn->prepare($sql);
    $smtm->execute($data);
    $result = $smtm->fetchAll(PDO::FETCH_ASSOC);
    $data_qty = [
        'QTY' => $_POST['QTY'],
    ];
    foreach ($result as $row) {
        if ($data_qty['QTY'] > $row['QTY_Product']) {
            $_SESSION['over_stock'] = 1;
            Header("Location:../User/index.php");
        }
        if ($data_qty['QTY'] <= $row['QTY_Product']) {
            $data_cart = [
                'ID_Product' => $_POST['ID_Product'],
                'ID_Member' => $_SESSION['ID_Member'],
                'QTY' => $_POST['QTY'],
            ];
            $sql_cart = "INSERT INTO cart (ID_Product,ID_Member,QTY) VALUES (:ID_Product,:ID_Member,:QTY)";
            $stmt_cart = $conn->prepare($sql_cart);
            $stmt_cart->execute($data_cart);


            // ตัด stock สินค้าเมื่อมีการหยิบลงตะกร้า
            $data_QTY = [
                'ID_Product' => $_POST['ID_Product'],
                'QTY' => $_POST['QTY'],

            ];
            $sql_QTY = "UPDATE stock SET QTY_Product=QTY_Product-:QTY WHERE ID_Product=:ID_Product AND Status_Product = 1";
            $stmt_QTY = $conn->prepare($sql_QTY);
            $stmt_QTY->execute($data_QTY);
            $_SESSION['cart'] = 1;
            Header("Location:../User/index.php");
        }
    }
}
?>