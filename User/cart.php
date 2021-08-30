    <!-- ต่อฐานข้อมูล -->
    <?php require_once('../sql/connect.php') ?>

    <?php

    @$data_member = [
        'ID_Member' => $_SESSION['ID_Member'],
    ];

    $sql_cart = "SELECT * ,SUM(c.QTY) as QTY FROM cart  as c
    JOIN stock as s ON c.ID_Product=s.ID_Product
    JOIN type_product as t ON s.TYPE_Product = t.ID_Type_Product
    WHERE c.ID_Member = :ID_Member
    GROUP BY c.ID_Product";
    $stmt_cart = $conn->prepare($sql_cart);
    $stmt_cart->execute($data_member);
    $result_cart = $stmt_cart->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php

    @$data_member = [
        'ID_Member' => $_SESSION['ID_Member'],
    ];

    $sql_cart_promotion = "SELECT * ,SUM(c.QTY) as QTY FROM cart  as c
    JOIN stock_promotion as sp ON c.ID_Product=sp.ID_Product_Promotion
    JOIN type_product as t ON sp.ID_Product_Promotion = t.ID_Type_Product
    WHERE c.ID_Member = :ID_Member
    GROUP BY c.ID_Product";
    $stmt_cart_promotion = $conn->prepare($sql_cart_promotion);
    $stmt_cart_promotion->execute($data_member);
    $result_cart_promotion = $stmt_cart_promotion->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!-- สินค้าในตะกร้า -->
    <?php
    if (@!$result_cart and @!$result_cart_promotion) { ?>
        <div class="row">
            <div class="col text-center mt-5">
                <h1><i class="far fa-times-circle"></i></h1>
                <h1>ไม่มีสินค้าในตะกร้าสินค้า</h1>
            </div>
        </div>
    <?php } ?>


    <?php
    if (@$result_cart or @$result_cart_promotion) { ?>
        <div class="offcanvas-body ">

            <form action="../sql/db_Add_oder.php?" method="post">
                <?php
                $total = 0;
                foreach ($result_cart as $row_cart) { ?>

                    <div class="row text-center mt-3 p-2 box_cart  shadow align-items-center">
                        <div class="col-md-2 col-4 ">
                            <img class="rounded" src="../Asset/img/<?php echo $row_cart['IMG_Product']; ?>" width="70" height="70">
                        </div>
                        <div class="col-md-3 col-2">
                            <p><?php echo $row_cart['NAME_Product']; ?> </p>

                        </div>

                        <div class="col-md-3 col-2 ">

                            <div class=" row">

                                <!-- ปุ่มลบออกจากตะกร้าจำนวน -->
                                <?php
                                if ($row_cart['QTY'] == 1) { ?>
                                    <div class="col-md-4 col-4">
                                        <i onclick="del_product_cart(<?php echo $row_cart['ID_Product']  ?>,<?php echo $row_cart['QTY']  ?>)" class="fas fa-minus minus_del"></i>
                                    </div>
                                <?php } ?>

                                <!-- ปุ่มลดจำนวน -->
                                <?php
                                if ($row_cart['QTY'] > 1) { ?>
                                    <div class="col-md-4 col-4">
                                        <i class="fas fa-minus minus" id="<?php echo $row_cart['ID_Product']; ?>"></i>
                                    </div>
                                <?php } ?>
                                <div class="col-md-4 col-4 ">
                                    <p name="QTY"><?php echo $row_cart['QTY']; ?></p>
                                </div>



                                <?php
                                if ($row_cart['QTY_Product'] != 0) { ?>
                                    <!-- ปุ่มเพิ่มจำนวน -->
                                    <div class="col-md-4 col-4">
                                        <i class="fas fa-plus plus" id="<?php echo $row_cart['ID_Product']; ?>"></i>
                                    </div>
                                <?php } ?>

                                <?php
                                // ถ้าสินค้ากับเท่าสินค้นคงเหลือจะไม่สามารถกดเพิ่มได้
                                if ($row_cart['QTY_Product'] == 0) { ?>
                                    <!-- ปุ่มเพิ่มจำนวน -->
                                    <div class="col-md-4 col-4">
                                        <i onclick="add_over()" class=" fas fa-plus"></i>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                        <div class="col-md-3 col-2">
                            <p><?php echo $row_cart['QTY'] * $row_cart['PRICE_Product']; ?> .-บาท</p>
                        </div>
                        <div class="col-md-1 col-2">
                            <a onclick="del_product_cart(<?php echo $row_cart['ID_Product']  ?>,<?php echo $row_cart['QTY']  ?>)" class=" btn btn-danger "><i class=" fas fa-trash-alt"></i> </a>
                        </div>
                    </div>

                    <!-- รวมราคาของในตะกร้า -->
                    <?php
                    $sum = $row_cart['QTY'] * $row_cart['PRICE_Product'];
                    $total = $total + $sum;
                    ?>
                <?php  } ?>

                <!--สินค้าโปรโมชั่น -->
                <?php
                foreach ($result_cart_promotion as $row_cart_promotion) { ?>

                    <div class="row text-center mt-3 p-2 box_cart  shadow align-items-center">
                        <div class="col-md-2 col-4 ">
                            <img class="rounded" src="../Asset/img/<?php echo $row_cart_promotion['IMG_Product']; ?>" width="70" height="70">
                        </div>
                        <div class="col-md-3 col-2">
                            <p><?php echo $row_cart_promotion['NAME_Product']; ?> </p>

                        </div>

                        <div class="col-md-3 col-2 ">

                            <div class=" row">

                                <!-- ปุ่มลบออกจากตะกร้าจำนวน -->
                                <?php
                                if ($row_cart_promotion['QTY'] == 1) { ?>
                                    <div class="col-md-4 col-4">
                                        <i onclick="del_product_cart(<?php echo $row_cart_promotion['ID_Product_Promotion']  ?>,<?php echo $row_cart_promotion['QTY']  ?>)" class="fas fa-minus minus_del"></i>
                                    </div>
                                <?php } ?>

                                <!-- ปุ่มลดจำนวน -->
                                <?php
                                if ($row_cart_promotion['QTY'] > 1) { ?>
                                    <div class="col-md-4 col-4">
                                        <i class="fas fa-minus minus" id="<?php echo $row_cart_promotion['ID_Product_Promotion']; ?>"></i>
                                    </div>
                                <?php } ?>
                                <div class="col-md-4 col-4 ">
                                    <p name="QTY"><?php echo $row_cart_promotion['QTY']; ?></p>
                                </div>

                                <?php
                                if ($row_cart_promotion['QTY_Product'] != 0) { ?>
                                    <!-- ปุ่มเพิ่มจำนวน -->
                                    <div class="col-md-4 col-4">
                                        <i class="fas fa-plus plus" id="<?php echo $row_cart_promotion['ID_Product_Promotion']; ?>"></i>
                                    </div>
                                <?php } ?>

                                <?php
                                // ถ้าสินค้ากับเท่าสินค้นคงเหลือจะไม่สามารถกดเพิ่มได้
                                if ($row_cart_promotion['QTY_Product'] == 0) { ?>
                                    <!-- ปุ่มเพิ่มจำนวน -->
                                    <div class="col-md-4 col-4">
                                        <i onclick="add_over()" class=" fas fa-plus"></i>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-3 col-2">
                            <p><?php echo $row_cart_promotion['QTY'] * $row_cart_promotion['POINT_Product']; ?> แต้ม</p>
                        </div>

                        <div class="col-md-1 col-2">
                            <a onclick="del_product_cart(<?php echo $row_cart_promotion['ID_Product_Promotion']  ?>,<?php echo $row_cart_promotion['QTY']  ?>)" class=" btn btn-danger "><i class=" fas fa-trash-alt"></i> </a>
                        </div>
                    </div>

                    <!-- รวมราคาของในตะกร้า -->
                    <?php
                    @$sum = $row_cart['QTY'] * $row_cart['PRICE_Product'];
                    $total = $total + $sum;
                    ?>
                <?php  } ?>


                <hr>
                <div class="row ">
                    <div class="col text-end ">

                        <?php
                        $potin = $total;
                        $Point =  $potin / 20;
                        ?>
                        <h5>ได้รับแต้ม <?php echo $Point; ?> แต้ม</h5>
                        <h5>ราคารวมทั้งหมด <?php echo number_format($total, 2) ?>.-บาท </h5>

                    </div>
                </div>
                <div class="row text-end mt-5">
                    <div class="col"> <button class="btn btn-success btn-lg " type="submit" name="Confirm_Oder">ยืนยันการสั่งซื้อ</button></div>
                </div>
            </form>
        </div>

    <?php } ?>



    <script>
        $(document).ready(function() {
            $('.plus').click(function() {
                var pid = $(this).attr("id");
                $.ajax({
                    url: "../sql/plus.php",
                    method: "post",
                    data: {
                        id: pid
                    },
                    success: function(result) {
                        $('#cart').load('cart.php');
                    },
                    error: function() {
                        alert('error');
                    }
                })
            });
        });
    </script>




    <script>
        $(document).ready(function() {
            $('.minus').click(function() {
                var pid = $(this).attr("id");
                $.ajax({
                    url: "../sql/minus.php",
                    method: "post",
                    data: {
                        id: pid
                    },
                    success: function(result) {
                        $('#cart').load('cart.php');
                    },
                    error: function() {
                        alert('error');
                    }
                })
            });
        });
    </script>

    <script>
        function add_over() {
            Swal.fire({
                icon: 'error',
                title: 'ขออภัยเนื้องจากสินค้าหมด',
                confirmButtonColor: '#d33',

            })
        }
    </script>

    <script>
        function del_product_cart(id, QTY) {
            Swal.fire({
                icon: 'error',
                title: 'คุณจะลบรายการนี้หรือไม่',
                confirmButtonText: `<a class="text-light" href="../sql/del.php?Cart_ID_Product=${id}&QTY=${QTY}">ยืนยัน</a>`,
                confirmButtonColor: '#d33',
                showCancelButton: true,
                cancelButtonText: `ยกเลิก`,
                cancelButtonColor: '#188754'
            })
        }
    </script>