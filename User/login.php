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
        <form action="../sql/db_Login.php" method="post">
            <div class="card p-5 box_login">
                <div class="row">
                    <h1>เข้าสู่ระบบ</h1>
                    <div class="col-md-6 col-6 mt-5 ">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input name="User" type="text" class="form-control" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input name="Pass" type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class=" text-center mt-5">
                            <button type="submit" name="Login" class="btn btn-success ">เข้าสู่ระบบ</button>
                        </div>
                        <div class=" text-center mt-3">
                            <a href="register.php">สมัครสมาชิก</a>
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


    <!-- แสดงรูปภาพอัตโนมัติ  โดยใน file ต้องมี accept="image/*" onchange="loadFile(event)" ละที่แสดงรูปโดยอ้างอิง ID output ของ div-->
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

</body>



</html>