<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.js" integrity="sha512-dhEwOlXtyz36+QteITRvQOAWr/d8kQKeHs4D/1yttrjtLxDj8qPIkgxYl3hR7NIRZUfZIqEPgTP1DG5AwNU7Jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
    <title>Home</title>
</head>

<body>
    <?php require_once('alert.php'); ?>
    <div class="container overflow-hidden">

        <?php require_once('navbar.php'); ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <form action="../sql/db_confrim_forgot_password.php" method="post">
            <div class="card p-5 box_login">
                <div class="row">
                    <div class="col-md-6 col-6 mt-5 ">
                        <div class="mb-2">
                            <label class="form-label">รหัส OTP</label>
                            <input name="OTP" type="number" class="form-control" placeholder="OTP..." required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">รหัสผ่านใหม่</label>
                            <input name="password" type="password" class="form-control" placeholder="รหัสผ่านใหม่" required>
                        </div>
                        <div class=" text-center mt-2">
                            <button type="submit" name="confrim_reset_password" class="btn btn-success">ยืนยัน</button>
                        </div>
                    </div>
                    <div class="col-md-6 col-6 img_Register ">
                        <img class="shadow-lg " src="https://images.unsplash.com/photo-1580913428735-bd3c269d6a82?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80"> <br>
                    </div>
                </div>
            </div>
        </form>


    </div>
    <script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>



</html>