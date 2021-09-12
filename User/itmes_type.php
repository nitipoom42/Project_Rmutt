<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<!-- เรียกข้อมูลประเภทสินค้าตาราง type_product-->
<?php
$sql_fetch_type = "SELECT  * FROM type_product;";
$smtm_fetch_type = $conn->prepare($sql_fetch_type);
$smtm_fetch_type->execute();
$result_type = $smtm_fetch_type->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<!-- Demo styles -->
<style>
    #box_items_typy .box {
        position: relative;
        height: 100px;
        margin-top: 2rem;
        margin-bottom: 5rem;
    }

    #box_items_typy .swiper {
        width: 100%;
        height: 100%;
    }

    #box_items_typy .swiper-slide {
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
        border-radius: 1.5rem;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    #box_items_typy .swiper-slide img {
        text-align: center;
        margin-right: 0.4rem;
        width: 5.5rem;
        height: 5.5rem;
        object-fit: cover;
        justify-content: center;
        align-items: center;
    }

    #box_items_typy .swiper-slide a {
        transition: 0.3s ease-in-out;
        color: #000;
        text-decoration: none;
    }

    #box_items_typy .swiper-slide:hover {
        box-shadow: rgba(0, 0, 0, 0.35) 0px 10px 20px;
    }

    #box_items_typy .swiper-pagination {
        position: absolute;


    }

    #box_items_typy .swiper-pagination_items_type {
        z-index: 10;
        top: 1rem;
    }

    #box_items_typy .swiper-pagination-bullet-active {
        background: #008065;
    }
</style>
<div id="box_items_typy" class="mt-5 mb-5">
    <h3>ประเภทสินค้า</h3>
    <!-- Swiper -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach ($result_type as $type_product) { ?>
                <div class="swiper-slide">
                    <a href="product_full.php?ID_Type_Product=<?php echo $type_product['ID_Type_Product']; ?>   "><img src="../Asset/img_type_product/<?php echo $type_product['IMG_Type_Product'] ?>"><?php echo $type_product['INFO_Type_Product'] ?></a>
                </div>
            <?php } ?>
        </div>

    </div>
    <div class="swiper-pagination_items_type"></div>
</div>



<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        freeMode: true,
        pagination: {
            el: ".swiper-pagination_items_type",

        },
    });
</script>