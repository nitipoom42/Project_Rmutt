<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<!-- เรียกข้อมูลประเภทสินค้าตาราง type_product-->
<?php
$sql_fetch_type = "SELECT  * FROM type_product;";
$smtm_fetch_type = $conn->prepare($sql_fetch_type);
$smtm_fetch_type->execute();
$result_type = $smtm_fetch_type->fetchAll(PDO::FETCH_ASSOC);
?>

<!-------------------------------------------------------------------->

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

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <title>Home</title>
</head>

<body>
    </head>


    <body>

        <?php
        // loopข้อมูลประเภทของสินค้า
        foreach ($result_type as $row_result_type_ID) { ?>
            <div class="row col-12 mb-5 mt-2 mx-auto">
                <div class="row mt-2  ">
                    <div class="col  text-center ">
                        <h4 class=" rounded-pill bg-success text-light p-2"> <?php echo $row_result_type_ID['INFO_Type_Product']; ?></h4>
                    </div>
                </div>
            </div>
            <!-------------------------------------------------------------------->
            <!-- เอา ID_Type_Product ของประเภทสินค้ามาเทียบค่าว่าตรงกับค่า ข้อมูลในตาราง stock
        และแสดงข้อมูลที่มี ID_Type_Product ตรงกันเท่านั้น -->
            <?php
            $data_type_ID = [
                'id' => $row_result_type_ID['ID_Type_Product'],
            ];
            $sql_id = "SELECT * FROM stock WHERE TYPE_Product =:id  LIMIT 4 ";
            $smtm_fetch_id = $conn->prepare($sql_id);
            $smtm_fetch_id->execute($data_type_ID);
            $result_id =  $smtm_fetch_id->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="swiper-container mySwiper">
                <div class="swiper-wrapper">
                    <?php foreach ($result_id as $row_stock) { ?>
                        <div class="swiper-slide">
                            <form action="../sql/db_Add_cart.php" method="post">
                                <a class="box_product " href="" data-bs-toggle="modal" data-bs-target="#product_popup<?php echo $row_stock['ID_Product']; ?>">
                                    <div class=" mt-2">
                                        <div class="box_info_product ">
                                            <div class="box_product_img accordion-bodyoverflow-hidden"> <img class=" card-img-top mx-auto" src="../Asset/img/<?php echo $row_stock['IMG_Product']; ?>"></div>

                                            <div class="card-body">
                                                <p class="card-text text-wrap"><?php echo $row_stock['NAME_Product']; ?></p>
                                                <h5 class="card-text text-success"><?php echo $row_stock['PRICE_Product']; ?> บาท</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <!-- ป็อบอัพหยิบลงกะตร้า -->

                                <!-- ปุ่มหยิบสินค้าลงตะกร้า -->
                                <input type="hidden" name="ID_Product" value="<?php echo $row_stock['ID_Product']; ?>">

                        </div>

                    <?php } ?>
                </div>

            </div>
            <!-- Modal -->
            <?php foreach ($result_id as $row_stock) { ?>
                <div class="modal fade" id="product_popup<?php echo $row_stock['ID_Product']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">สินค้าประเภท <?php echo $row_result_type_ID['INFO_Type_Product']; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img class="card-img-top mx-auto" src="../Asset/img/<?php echo $row_stock['IMG_Product']; ?>">
                                <p><?php echo $row_stock['NAME_Product']; ?></p>
                                <div class="row text-center">
                                    <div class="col-md-6 mx-auto text-center ">
                                        <div class="input-group mb-3">
                                            <a class="btn btn_number me-2" onclick="dec('QTY<?php echo $row_stock['ID_Product']; ?>')"><i class="fas fa-minus"></i></a>
                                            <input class="form-control text-center" id="QTY<?php echo $row_stock['ID_Product']; ?>" name="QTY" type="number" readonly value="1">
                                            <a class="btn btn_number ms-2" onclick="inc('QTY<?php echo $row_stock['ID_Product']; ?>')"><i class="fas fa-plus"></i></a>
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
            <?php } ?>
            </form>
            <!-- Loop ชั้นที่สองที่แสดงสินค้าที่ ID_Type_Product ตรงกับ TYPE_Product ของสินค้านั้นๆ-->

            <div class="row">
                <div class="col">
                    <div class="text-end type_full mt-2">
                        <a href="product_full.php?ID_Type_Product=<?php echo $row_result_type_ID['ID_Type_Product']; ?>   ">สินค้าเพิ่มเติม...</a>
                    </div>
                </div>
            </div>
            <hr>
        <?php } ?>


        <!-- Swiper -->
        <div class="swiper-container mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">

                </div>
                <div class="swiper-slide">Slide 2</div>
                <div class="swiper-slide">Slide 3</div>
                <div class="swiper-slide">Slide 4</div>
                <div class="swiper-slide">Slide 5</div>
                <div class="swiper-slide">Slide 6</div>
                <div class="swiper-slide">Slide 7</div>
                <div class="swiper-slide">Slide 8</div>
                <div class="swiper-slide">Slide 9</div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Swiper JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 4,
                spaceBetween: 30,
                centeredSlides: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        </script>







        <script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>


    </body>

</html>