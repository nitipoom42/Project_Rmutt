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
WHERE ID_Member=:ID_Member AND s.Status_Product = 1
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
                    <span class="input-group-text"><i class="fas fa-barcode me-2"></i></span>
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
        <!-- ใบเสร็จ -->
        <div id="box_bill" class="col-5 box_bill ">
            <div class="row justify-content-center">
                <h4 class="text-center">ร้านน้องมายด์</h4>
                <small class="text-center mb-3">ใบเสร็จรับเงิน</small>
                <?php
                $total_bill = 0;
                foreach ($result_cart_sell as $row_bill) { ?>
                    <div class="row">
                        <div class="col-1">
                            <p><?php echo $row_bill['QTY']; ?></p>
                        </div>
                        <div class="col-7">
                            <p> <?php echo $row_bill['NAME_Product']; ?></p>
                        </div>
                        <div class="col-3 text-end">
                            <p> <?php echo number_format($row_bill['QTY'] * $row_bill['PRICE_Product'], 2)  ?></p>
                        </div>
                    </div>
                    <?php
                    $sum_bill = $row_bill['QTY'] *  $row_bill['PRICE_Product'];
                    $total_bill = $total_bill + $sum_bill;
                    ?>
                <?php } ?>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-9 text-end">
                        <div class="">
                            <div id="" class="">ยอดเงินทั้งหมด <?php echo $total_bill  ?>.00 บาท </div>
                            <input id="total_bill" type="hidden" value="<?php echo $total_bill  ?>">
                        </div>
                        <div class="">
                            <div id="default_money" class="">รับเงินมา 00.00 </div>
                            <div id="show_get_money"></div>
                        </div>
                        <div class="">
                            <div class="show_change"></div>
                            <div id="show_point"></div>
                            <input type="hidden" name="" id="show_change1" value="">
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <small>400/880 ซอย 2/6 หมู่บ้านเอื้ออาทร หมู่ 9 ตำบลตาลเดี่ยว อำเภอแก่งคอย จังหวัดสระบุรี 18110 </small>
                        <small>โทร.091-234-5678</small>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-3 box_payment mt-5 ms-5">
            <!-- จำนวนเงินที่รับมา -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fab fa-bitcoin"></i></span>
                <input id="Tel_member" type="text" class="form-control" placeholder="เบอร์สมาชิก...">
            </div>
            <!-- สะสมแต้ม -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                <input id="get_money" type="number" min="0" class="form-control" placeholder="จำนวนเงิน...">
            </div>

            <button class="btn btn-warning btn-lg col-12 cal">คำนวนเงิน</button>
            <hr>
            <div class="text-danger h1 text-center mb-5 mt-5">
                <div class="show_change"></div>
            </div>
            <div id="final_oder">
                <button id="btn_confirm_sell" onclick="printJS({
                        printable: 'box_bill',
                        type: 'html',
                        css:[
                         '../Asset/Bootstrap/css/bootstrap.min.css',
                        '../Asset/css.css'
                    ]
                })" class="btn btn-success btn-lg col-12 confirm_sell confirm_sell_none">ออกใบเสร็จ</button>
            </div>
        </div>
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
                    ID_Product: ID_Product,
                },
                success() {
                    ID_Product = $('#Select_ID_Product').val("");
                    $('#sell').load('sell_items.php');

                }
            });
        });
        $('.confirm_sell').click(function() {
            var total_bill = parseInt(document.getElementById('total_bill').value);
            var point = (total_bill / 30).toFixed(0).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            var Tel = document.getElementById('Tel_member').value;
            $.ajax({
                url: "../sql/confirm_sell.php",
                method: "post",
                data: {
                    Tel: Tel,
                    point: point,
                },
                success() {
                    $('#sell').load('sell.php');
                    Swal.fire({
                        title: 'ทำรายการสำเร็จ',
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#3085d6',
                    })
                }
            });
        });
        // คำนวน
        $('.cal').click(function() {
            var get_money = parseInt(document.getElementById('get_money').value);
            var total_bill = parseInt(document.getElementById('total_bill').value);
            var change = (get_money - total_bill);

            // คำนวนเงิน
            if (get_money >= total_bill) {
                $('#show_get_money').html('รับเงินมา ' + get_money + '.00' + ' บาท');
                $('.show_change').html('เงินทอน ' + change + '.00' + ' บาท');
                $('#default_money').hide();
                $('#btn_confirm_sell').addClass('confirm_sell_show');

            } else {
                Swal.fire({
                    title: 'ยอดเงินไม่เพียงพอ',
                    icon: 'warning',
                    timer: 2500,
                    showConfirmButton: false,
                })
            }
            // สะสมแต้ม
            if (Tel_member != "") {
                var Tel_member = document.getElementById('Tel_member').value;
                $.ajax({
                    url: "../sql/db_point_front_sell.php",
                    method: "post",
                    dataType: "json",
                    data: {
                        Tel_member: Tel_member
                    },
                    success(data) {
                        $('#show_change1').val(data);
                        var show_change1 = document.getElementById('show_change1').value;
                        if (show_change1 == 1) {
                            var cal_point = (total_bill / 30).toFixed(0).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            $('#show_point').html('ได้รับแต้ม ' + cal_point);
                        }
                    },
                });
            }
        });
    });
</script>


<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">