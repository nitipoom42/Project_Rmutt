<?php
require_once('../sql/connect.php');
?>

<?php require_once('../User/alert.php') ?>

<?php

$data_cart_sell = [
    'ID_Member' => $_SESSION['ID_Member']
];

$sql_cart_sell = "SELECT * ,SUM(c.QTY) as QTY FROM cart as c
JOIN stock as s ON  c.ID_Product=s.ID_Product
JOIN type_product as t ON s.TYPE_Product = t.ID_Type_Product
WHERE ID_Member=:ID_Member
GROUP BY c.ID_Product";
$stmt_cart_sell = $conn->prepare($sql_cart_sell);
$stmt_cart_sell->execute($data_cart_sell);
$result_cart_sell = $stmt_cart_sell->fetchAll(PDO::FETCH_ASSOC);
?>




<div id="sell_items">
    <div class="row ms-2 mt-2">

        <div class="col-5 box_sell_product">
            <div class="row mb-2">
                <div class="col-12 input-group">
                    <span class="input-group-text"><i class="fas fa-barcode me-2"></i>รหัสสินค้า</span>
                    <input class="form-control col-12" autofocus name="ID_Product" id="Select_ID_Product" placeholder="รหัสสินค้า...">
                </div>
            </div>
            <div class="row mb-4 mt-2 justify-content-center text-center">
                <div class="col-2 h4">รูป</div>
                <div class="col-4 h4 text-start">ชื่อสินค้า</div>
                <div class="col-2 h4">จำนวน</div>
                <div class="col-2 h4">ราคา</div>
                <div class="col-1 h4"></div>
            </div>
            <?php
            if (!$result_cart_sell) { ?>
                <div class="row mt-5">
                    <div class="col text-center mt-5">
                        <h1><i class="far fa-times-circle"></i></h1>
                        <h1>ไม่มีรายการสินค้า</h1>
                    </div>
                </div>
            <?php  } ?>

            <?php
            if ($result_cart_sell) { ?>
                <?php
                $total = 0;
                foreach ($result_cart_sell as $row_cart_sell) { ?>

                    <div class="row justify-content-center text-center align-items-center mt-2 ">

                        <div class="col-2"> <img width="65" height="65" src="../Asset/img/<?php echo $row_cart_sell['IMG_Product']; ?>"></div>
                        <div class="col-4 text-start"> <?php echo $row_cart_sell['NAME_Product']; ?> </div>
                        <div class="col-2"> <?php echo $row_cart_sell['QTY']; ?> </div>
                        <div class="col-2"> <?php echo $row_cart_sell['QTY'] *  $row_cart_sell['PRICE_Product'] ?>.-บาท </div>
                        <div class="col-1 btn btn-danger btn-sm del_sell<?php echo $row_cart_sell['ID_Product']; ?>"><i class=" fas fa-trash-alt"></i></div>
                        <input type="hidden" id="ID_Cart<?php echo $row_cart_sell['ID_Cart']; ?>" value="<?php echo $row_cart_sell['ID_Cart']; ?>">
                        <input type="hidden" id="Cart_ID_Product<?php echo $row_cart_sell['ID_Cart']; ?>" value="<?php echo $row_cart_sell['ID_Product']; ?>">
                    </div>
                    <?php
                    $sum = $row_cart_sell['QTY'] *  $row_cart_sell['PRICE_Product'];
                    $total = $total + $sum;
                    ?>

                    <script>
                        // ปุ่มสินค้า
                        $(document).ready(function() {
                            $('.del_sell<?php echo $row_cart_sell['ID_Product']; ?>').click(function() {
                                var ID_Cart = $('#ID_Cart<?php echo $row_cart_sell['ID_Cart']; ?>').val();
                                var Cart_ID_Product = $('#Cart_ID_Product<?php echo $row_cart_sell['ID_Cart']; ?>').val();
                                $.ajax({
                                    url: "../sql/del.php",
                                    method: "post",
                                    data: {
                                        action: 'del_sell',
                                        ID_Cart: ID_Cart,
                                        Cart_ID_Product: Cart_ID_Product,
                                    },
                                    success() {
                                        $('#sell_items').load('sell_items.php');
                                    },

                                });
                            });
                        });
                    </script>
                <?php } ?>
        </div>
        <div class="col-2 text-center box_payment">
            <h4 class="text-start">ราคาทั้งหมด <?php echo $total; ?>.-บาท</h4>
            <button class="btn btn-success btn-lg col-12 confirm_sell">ชำระเงิน</button>
        </div>
    <?php  } ?>




    </div>
</div>


<script>
    $(document).ready(function() {
        $("#Select_ID_Product").focus();
        $('#Select_ID_Product').change(function() {
            var ID_Product = $('#Select_ID_Product').val();
            $.ajax({
                url: "../sql/db_Add_cart_sell.php",
                method: "post",
                data: {
                    ID_Product: ID_Product
                },
                success() {
                    ID_Product = $('#Select_ID_Product').val("");
                    $('#sell').load('sell_items.php');
                }
            });
        });
        $('.confirm_sell').click(function() {
            $.ajax({
                url: "../sql/confirm_sell.php",
                success() {
                    $('#sell').load('sell.php');
                    Swal.fire({
                        title: 'ทำรายการสำเร็จ',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false,
                    })
                }
            });
        });
    });
</script>