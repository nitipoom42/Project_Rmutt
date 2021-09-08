<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<!-- เรียกข้อมูลประเภทสินค้าตาราง type_product-->
<?php
$sql_fetch_type = "SELECT  * FROM type_product WHERE NOT ID_Type_Product=1";
$smtm_fetch_type = $conn->prepare($sql_fetch_type);
$smtm_fetch_type->execute();
$result_type = $smtm_fetch_type->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- sweetalert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.js" integrity="sha512-dhEwOlXtyz36+QteITRvQOAWr/d8kQKeHs4D/1yttrjtLxDj8qPIkgxYl3hR7NIRZUfZIqEPgTP1DG5AwNU7Jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">

<style>
    #box_items_product .box_items_product {
        position: relative;
        margin-top: 10rem;
        margin-bottom: 10rem;
    }

    #box_items_product .swiper {
        width: 100%;
        height: 100%;
        background: none;

    }

    #box_items_product .swiper-slide {
        background: #fff;
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
        transition: 0.3s ease-in-out;
        border-radius: 1rem;
    }

    #box_items_product .swiper-slide img {
        text-align: center;
        margin-right: 0.4rem;
        width: 10rem;
        height: 10rem;
        object-fit: cover;
        justify-content: center;
        align-items: center;
    }

    #box_items_product .swiper-slide a {
        transition: 0.3s ease-in-out;
        color: #000;
        text-decoration: none;
        border-radius: 1rem;
    }

    #box_items_product .swiper-slide:hover {
        box-shadow: rgba(0, 0, 0, 0.35) 0px 10px 20px;
        border-radius: 1rem;
    }

    #box_items_product .swiper-pagination-bullet-active {
        background: #008065;
    }
</style>
</head>

<body>
    <div id="box_items_product">
        <!-- Swiper -->
        <?php foreach ($result_type as $row_result_type_ID) { ?>
            <div class="row mb-2 mt-5 mx-auto justify-content-between align-items-center">

                <div class="col-2  text-center ">
                    <h4 class=" rounded-pill bg_head_peoduct text-light p-2"> <?php echo $row_result_type_ID['INFO_Type_Product']; ?></h4>
                </div>
                <div class="col">
                    <div class="text-end type_full mt-2">
                        <a href="product_full.php?ID_Type_Product=<?php echo $row_result_type_ID['ID_Type_Product']; ?>   ">ดูทั้งหมด <i class="fas fa-angle-double-right"></i></a>
                    </div>
                </div>

            </div>

            <?php
            $data_type_ID = [
                'id' => $row_result_type_ID['ID_Type_Product'],
            ];
            $sql_id = "SELECT * FROM stock WHERE TYPE_Product =:id ";
            $smtm_fetch_id = $conn->prepare($sql_id);
            $smtm_fetch_id->execute($data_type_ID);
            $result_id =  $smtm_fetch_id->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div class="swiper mySwiper ">
                <div class="swiper-wrapper">
                    <?php foreach ($result_id as $row_stock) { ?>
                        <div class="swiper-slide shadow">
                            <a <?php if ($row_stock['QTY_Product'] > 0) { ?> onclick="stock<?php echo $row_stock['ID_Product']; ?>() <?php   } ?>" <?php if ($row_stock['QTY_Product'] == 0) { ?> onclick=" out_stock() <?php   } ?>" class="box_product" data-bs-target="<?php
                                                                                                                                                                                                                                                                            if ($row_stock['QTY_Product'] > 0) { ?>
                    #product_popup<?php echo $row_stock['ID_Product'] ?>
                <?php } ?>">
                                <div class=" mt-1">
                                    <div class="">
                                        <div class=" <?php
                                                        if ($row_stock['QTY_Product'] == 0) {
                                                            echo "outstock";
                                                        }

                                                        ?> accordion-body overflow-hidden"> <img class=" card-img-top mx-auto" src="../Asset/img/<?php echo $row_stock['IMG_Product']; ?>"></div>
                                        <div class="card-body">
                                            <p class="card-text text-wrap"><?php echo $row_stock['NAME_Product']; ?></p>
                                            <h5 class="card-text text-success"><?php echo $row_stock['PRICE_Product']; ?> บาท</h5>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($row_stock['QTY_Product'] == 0) { ?>
                                    <div class="info_outstock">
                                        <h5 class="mt-2">ขออภัยสินค้าหมด</h5>
                                    </div>
                                <?php    } ?>

                            </a>
                            <script>
                                function stock<?php echo $row_stock['ID_Product']; ?>() {
                                    Swal.fire({
                                        html: `<form action="../sql/db_Add_cart.php" method="post">
                                <div class="overflow-hidden">
                                <img class="card-img-top mx-auto " src="../Asset/img/<?php echo $row_stock['IMG_Product']; ?> ">
                                        <div class="text-center">
                                            <p><?php echo $row_stock['NAME_Product']; ?></p>
                                            <p>สินค้าคงเหลือ <?php echo $row_stock['QTY_Product']; ?></p>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-md-6 mx-auto text-center ">
                                                <div class="input-group mb-3">
                                                    <a class="btn btn_number me-2" onclick="dec('QTY<?php echo $row_stock['ID_Product']; ?>')"><i class="fas fa-minus"></i></a>
                                                    <input class="form-control text-center" id="QTY<?php echo $row_stock['ID_Product']; ?>" name="QTY" type="number" value="1">
                                                    <a class="btn btn_number ms-2" onclick="inc('QTY<?php echo $row_stock['ID_Product']; ?>')"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-success" type="submit" name="Add_Cart">หยิบลงตะกร้า</button>
                                    </div>
                                    <input type="hidden" name="ID_Product" value="<?php echo $row_stock['ID_Product']; ?>">
                                    </div>
                                    </form>`,
                                        showConfirmButton: false,
                                    });
                                }
                            </script>
                        </div>

                    <?php } ?>
                </div>
                <div class="swiper-pagination1"></div>
            </div>
        <?php } ?>
    </div>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>



    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 10,
            freeMode: true,
            pagination: {
                el: ".swiper-pagination1",
                clickable: true,
            },
        });
    </script>

    <script>
        function out_stock() {
            Swal.fire({
                icon: 'error',
                title: 'ขออภัยเนื้องจากสินค้าหมด',
                confirmButtonText: 'ยืนยัน',
                confirmButtonColor: '#d33',

            });
        }
    </script>

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
</body>

</html>