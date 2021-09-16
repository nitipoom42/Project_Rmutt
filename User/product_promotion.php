<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<!-- เรียกข้อมูลประเภทสินค้าตาราง type_product-->
<?php
$sql_fetch_promotion = "SELECT  * FROM stock_promotion as sp
JOIN type_product as tp ON sp.TYPE_Product = tp.ID_Type_Product WHERE Status_Product=1";
$smtm_fetch_promotion = $conn->prepare($sql_fetch_promotion);
$smtm_fetch_promotion->execute();
$result_promotion = $smtm_fetch_promotion->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

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
        <?php foreach ($result_promotion as $row_promotion) { ?>
            <div class="row mb-2 mt-5 mx-auto justify-content-between align-items-center">

                <div class="col-2  text-center ">
                    <h4 class=" rounded-pill bg_head_peoduct p-2"> <?php echo $row_promotion['INFO_Type_Product']; ?></h4>
                </div>
                <div class="col">
                    <div class="text-end type_full mt-2">
                        <a href="product_promotion_full.php">ดูทั้งหมด <i class="fas fa-angle-double-right"></i></a>
                    </div>
                </div>

            </div>
            <div class="swiper mySwiper ">
                <div class="swiper-wrapper">

                    <div class="swiper-slide shadow">
                        <a <?php if ($row_promotion['QTY_Product'] > 0) { ?> onclick="stock<?php echo $row_promotion['ID_Product_Promotion']; ?>() <?php   } ?>" <?php if ($row_promotion['QTY_Product'] == 0) { ?> onclick=" out_stock() <?php   } ?>" class="box_product" data-bs-target="<?php
                                                                                                                                                                                                                                                                                            if ($row_promotion['QTY_Product'] > 0) { ?>
                    #product_popup<?php echo $row_promotion['ID_Product_Promotion'] ?>
                <?php } ?>">
                            <div class=" mt-1">
                                <div class="">
                                    <div class=" <?php
                                                    if ($row_promotion['QTY_Product'] == 0) {
                                                        echo "outstock";
                                                    }

                                                    ?> accordion-body overflow-hidden"> <img class=" card-img-top mx-auto" src="../Asset/img_promotion/<?php echo $row_promotion['IMG_Product']; ?>"></div>
                                    <div class="card-body">
                                        <p class="card-text text-wrap"><?php echo $row_promotion['NAME_Product']; ?></p>
                                        <h5 class="card-text text-success"><?php echo $row_promotion['POINT_Product']; ?> แต้ม</h5>
                                    </div>
                                </div>
                            </div>
                            <?php if ($row_promotion['QTY_Product'] == 0) { ?>
                                <div class="info_outstock">
                                    <h5 class="mt-2">ขออภัยสินค้าหมด</h5>
                                </div>
                            <?php    } ?>
                        </a>
                        <script>
                            function stock<?php echo $row_promotion['ID_Product_Promotion']; ?>() {
                                Swal.fire({
                                    html: `<form action="../sql/db_Add_cart_Promotion.php" method="post">
                                <div class="overflow-hidden">
                                <img class="card-img-top mx-auto " src="../Asset/img_promotion/<?php echo $row_promotion['IMG_Product']; ?> ">
                                        <div class="text-center">
                                            <p><?php echo $row_promotion['NAME_Product']; ?></p>
                                            <p>สินค้าคงเหลือ <?php echo $row_promotion['QTY_Product']; ?></p>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-md-6 mx-auto text-center ">
                                                <div class="input-group mb-3">
                                                    <a class="btn btn_number me-2" onclick="dec('QTY<?php echo $row_promotion['ID_Product_Promotion']; ?>')"><i class="fas fa-minus"></i></a>
                                                    <input class="form-control text-center" id="QTY<?php echo $row_promotion['ID_Product_Promotion']; ?>" name="QTY" min="1" type="number" value="1">
                                                    <a class="btn btn_number ms-2" onclick="inc('QTY<?php echo $row_promotion['ID_Product_Promotion']; ?>')"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-success" type="submit" name="Add_Cart">หยิบลงตะกร้า</button>
                                    </div>
                                    <input type="hidden" name="ID_Product_Promotion" value="<?php echo $row_promotion['ID_Product_Promotion']; ?>">
                                    </div>
                                    </form>`,
                                    showConfirmButton: false,
                                });
                            }
                        </script>
                    </div>


                </div>
                <div class="swiper-pagination1"></div>
            </div>
        <?php } ?>
    </div>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

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