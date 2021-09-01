<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>
<?php $page = "index" ?>



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

    <title>Home</title>
</head>

<body>
    <?php require_once('alert.php'); ?>
    <!-- banner -->

    <div class="container ">
        <!-- เมนู -->
        <?php require_once('navbar.php'); ?>
        <br>
        <br>
        <?php require_once('banner.php'); ?>
        <!-- โปรโมชั่น -->
        <?php require_once('product_promotion.php'); ?>
        <!-- ประเภทสินค้า -->
        <?php require_once('itmes_type.php'); ?>
        <!-- สินค้าแต่ละประเภท -->
        <?php require_once('type_product.php'); ?>

        <!-- สินค้าแต่ละประเภท -->




        <br>
        <br>
        <br>
        <br>
        <?php require_once('menu.php'); ?>
    </div>



    <script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="../Asset/slick/slick/slick.min.js"></script>



    <script>
        $(document).ready(function() {
            setInterval(function() {
                $("#result").load('navbar.php');
            });
        });
    </script>




</body>

</html>