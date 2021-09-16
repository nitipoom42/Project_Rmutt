<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>




<!-- เรียกข้อมูลประเภทสินค้าตาราง type_product-->
<?php
$sql_fetch_type = "SELECT  * FROM type_product as tp
INNER JOIN stock as s ON tp.ID_Type_Product = s.TYPE_Product
WHERE s.Status_Product=1 AND NOT ID_Type_Product=1
ORDER BY ID_Pro DESC";
$smtm_fetch_type = $conn->prepare($sql_fetch_type);
$smtm_fetch_type->execute();
$result_type = $smtm_fetch_type->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Css -->
    <link rel="stylesheet" href="../Asset/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Asset/css.css">

    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="../Asset/slick/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="../Asset/slick/slick/slick-theme.css" />

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.js" integrity="sha512-dhEwOlXtyz36+QteITRvQOAWr/d8kQKeHs4D/1yttrjtLxDj8qPIkgxYl3hR7NIRZUfZIqEPgTP1DG5AwNU7Jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
    <title>Home</title>


</head>

<body>
    <div class="container">

        <?php require_once('navbar.php'); ?>
        <br>
        <br>
        <br>


        <div class="row mt-5">
            <?php
            foreach ($result_type as $row_type) { ?>
                <div class="col-md-3">

                    <form action="../sql/db_Add_cart.php" method="post">
                        <a <?php if ($row_type['QTY_Product'] == 0) { ?> onclick=" out_stock() <?php   } ?>" class=" box_product" data-bs-toggle="modal" data-bs-target="<?php
                                                                                                                                                                            if ($row_type['QTY_Product'] > 0) { ?>
                    #product_popup<?php echo $row_type['ID_Product'] ?>
                <?php } ?>">
                            <div class=" mt-2">
                                <div class="box_info_product ">
                                    <div class="box_product_img <?php
                                                                if ($row_type['QTY_Product'] == 0) {
                                                                    echo "outstock";
                                                                }

                                                                ?> accordion-bodyoverflow-hidden"> <img class=" card-img-top mx-auto" src="../Asset/img/<?php echo $row_type['IMG_Product']; ?>"></div>
                                    <div class="card-body">
                                        <p class="card-text text-wrap"><?php echo $row_type['NAME_Product']; ?></p>
                                        <h5 class="card-text text-success"><?php echo $row_type['PRICE_Product']; ?> บาท</h5>
                                    </div>
                                </div>
                            </div>
                            <?php if ($row_type['QTY_Product'] == 0) { ?>
                                <div class="info_outstock ">
                                    <h5 class="mt-2">ขออภัยสินค้าหมด</h5>
                                </div>
                            <?php    } ?>
                        </a>
                        <!-- ป็อบอัพหยิบลงกะตร้า -->
                        <!-- Modal -->
                        <div class="modal fade" id="product_popup<?php echo $row_type['ID_Product']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">สินค้าประเภท <?php echo $row_type['INFO_Type_Product']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img class="card-img-top mx-auto" src="../Asset/img/<?php echo $row_type['IMG_Product']; ?>">
                                        <div class="text-center">
                                            <p><?php echo $row_type['NAME_Product']; ?></p>
                                            <p>สินค้าคงเหลือ <?php echo $row_type['QTY_Product']; ?></p>
                                        </div>

                                        <div class="row text-center">
                                            <div class="col-md-6 mx-auto text-center ">
                                                <div class="input-group mb-3">
                                                    <a class="btn btn_number me-2" onclick="dec('QTY<?php echo $row_type['ID_Product']; ?>')"><i class="fas fa-minus"></i></a>
                                                    <input class="form-control text-center" id="QTY<?php echo $row_type['ID_Product']; ?>" name="QTY" min="1" type="number" value="1">
                                                    <a class="btn btn_number ms-2" onclick="inc('QTY<?php echo $row_type['ID_Product']; ?>')"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success" type="submit" name="Add_Cart">หยิบลงตะกร้า</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ปุ่มหยิบสินค้าลงตะกร้า -->
                        <input type="hidden" name="ID_Product" value="<?php echo $row_type['ID_Product']; ?>">
                    </form>
                </div>
            <?php    } ?>
        </div>

        <br>
        <br>
        <br>
        <?php require_once('menu.php'); ?>

    </div>
</body>

<script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>
<!-- sweetalert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function inc(element) {
        let el = document.querySelector(`[id="${element}"]`);
        el.value = parseInt(el.value) + 1;
    }

    function dec(element) {
        let el = document.querySelector(`[id="${element}"]`);
        if (parseInt(el.value) > 0) {
            el.value = parseInt(el.value) - 1;
        }
    }
</script>

<script>
    function out_stock() {
        Swal.fire({
            icon: 'error',
            title: 'ขออภัยเนื้องจากสินค้าหมด',
            confirmButtonText: 'ยืนยัน',
            confirmButtonColor: '#d33',
        })
    }
</script>

</html>