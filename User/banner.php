    <!-- ต่อฐานข้อมูล -->
    <?php require_once('../sql/connect.php') ?>

    <!-- เรียกข้อมูลประเภทสินค้าตาราง type_product-->
    <?php
    $sql_banner = "SELECT  * FROM banner;";
    $smtm_banner = $conn->prepare($sql_banner);
    $smtm_banner->execute();
    $result_banner = $smtm_banner->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="../Asset/slick/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="../Asset/slick/slick/slick-theme.css" />

    <link rel="stylesheet" href="../Asset/css.css">

    <div class="autoplay">
        <?php
        foreach ($result_banner as $row_banner) { ?>
            <div class="banner_promotion">
                <img src="../Asset/img_banner/<?php echo $row_banner['IMG_Banner'] ?>" alt="">
            </div>


        <?php  } ?>

    </div>

    <!-- slick -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="../Asset/slick/slick/slick.min.js"></script>


    <script>
        $('.autoplay').slick({
            dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            autoplay: true

        });
    </script>