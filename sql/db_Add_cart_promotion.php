<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php') ?>

<?php

// เช็คก่อนว่า User ทำการlogin แล้วหรือยัง ถ้ายังก็ให้ทำการ login ก่อนถึงจะหยิบของลงตะกร้าได้
if (empty($_SESSION['User'])) {

    Header("Location:../User/login.php");
}
// เพิ่มของลงตะกร้า    
else if (isset($_POST['Add_Cart'])) {

    $data_member = [
        'ID_Member' => $_SESSION['ID_Member'],
    ];
    // result($data['QTY']);
    $sql_member = "SELECT * FROM member WHERE ID_Member =:ID_Member";
    $smtm_member = $conn->prepare($sql_member);
    $smtm_member->execute($data_member);
    $result_member =  $smtm_member->fetchAll(PDO::FETCH_ASSOC);

    $data = [
        'ID_Product_Promotion' => $_POST['ID_Product_Promotion'],
    ];
    // result($data['QTY']);
    $sql = "SELECT * FROM stock_promotion WHERE ID_Product_Promotion =:ID_Product_Promotion";
    $smtm = $conn->prepare($sql);
    $smtm->execute($data);
    $result =  $smtm->fetchAll(PDO::FETCH_ASSOC);

    $data_qty = [
        'QTY' => $_POST['QTY'],
    ];
}
foreach ($result as $row) {
    if ($data_qty['QTY'] > $row['QTY_Product']) {
        $_SESSION['over_stock'] = 1;
        Header("Location:../User/index.php");
    }
    foreach ($result_member as $row_member) {
        if ($data_qty['QTY'] * $row['POINT_Product'] > $row_member['Point']) {
            $_SESSION['over_stock_promotion'] = 1;
            Header("Location:../User/index.php");
        } else {
            if ($data_qty['QTY'] <= $row['QTY_Product']) {
                $data_cart = [
                    'ID_Product_Promotion' => $_POST['ID_Product_Promotion'],
                    'ID_Member' => $_SESSION['ID_Member'],
                    'QTY' => $_POST['QTY'],
                ];
                $sql_cart = "INSERT INTO cart (ID_Product,ID_Member,QTY) VALUES (:ID_Product_Promotion,:ID_Member,:QTY)";
                $stmt_cart = $conn->prepare($sql_cart);
                $stmt_cart->execute($data_cart);
                // ตัด stock สินค้าเมื่อมีการหยิบลงตะกร้า
                $data_QTY = [
                    'ID_Product_Promotion' => $_POST['ID_Product_Promotion'],
                    'QTY' => $_POST['QTY'],

                ];
                $sql_QTY = "UPDATE stock_promotion SET QTY_Product=QTY_Product-:QTY WHERE ID_Product_Promotion=:ID_Product_Promotion ";
                $stmt_QTY = $conn->prepare($sql_QTY);
                $stmt_QTY->execute($data_QTY);


                $data_promotion = [
                    'ID_Member' => $_SESSION['ID_Member'],
                    'Point_Product' => $_POST['Point_Product'],
                    'QTY' => $_POST['QTY']
                ];
                $sql_point = "UPDATE member SET Point=Point-(:QTY*:Point_Product) WHERE ID_Member=:ID_Member ";
                $stmt_point = $conn->prepare($sql_point);
                $stmt_point->execute($data_promotion);
                $_SESSION['cart'] = 1;
                Header("Location:../User/index.php");
            }
        }
    }
}
?>