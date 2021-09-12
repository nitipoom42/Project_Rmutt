<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>
<?php $page = "payment" ?>

<?php
$sql_payment = "SELECT * FROM bank";
$stmt_payment = $conn->prepare($sql_payment);
$stmt_payment->execute();

$result_payment = $stmt_payment->fetchAll(PDO::FETCH_ASSOC);
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

    <title>ช่องทางการชำระเงิน</title>
</head>

<body>
    <?php require_once('alert.php'); ?>
    <!-- banner -->

    <div class="container">


        <!-- เมนู -->
        <?php require_once('navbar.php'); ?>
        <br>
        <br>
        <br>
        <br>


        <div class="row">
            <div class="col-md-6">
                <div class="card box_address ">
                    <div class="ms-5 mt-3">
                        <h4>ร้านตั้งอยู่ที่ <i class="fas fa-map-marker-alt"></i></h4>
                        <p>400/880 ซอย 2/6 หมู่บ้านเอื้ออาทร</p>
                        <p>หมู่ 9 ตำบลตาลเดี่ยว อำเภอแก่งคอย</p>
                        <p>จังหวัดสระบุรี รหัสไปรษณีย์ 18110</p>
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1930.9868054173103!2d101.0134048687771!3d14.54350180541503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311dc2f74d8e0393%3A0x11b256b02685cdc0!2z4Lia4LmJ4Liy4LiZ4LmA4Lit4Li34LmJ4Lit4Lit4Liy4LiX4LijIOC5geC4geC5iOC4h-C4hOC4reC4og!5e0!3m2!1sth!2sth!4v1631277796838!5m2!1sth!2sth" width="630" height="450" style="border:1;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            <div class="col-md-6">
                <h3>ช่องทางการชำระเงิน</h3>
                <?php
                foreach ($result_payment as $row_payment) { ?>
                    <div class="row">
                        <div class="col mb-2">
                            <img class="img_payment shadow" src="../Asset/img_bank/<?php echo $row_payment['IMG_bank']; ?>" alt="">
                        </div>
                    </div>

                <?php  } ?>
            </div>
        </div>




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