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

    <title>Home</title>


</head>

<body>
    <div class="container overflow-hidden">

        <?php require_once('navbar.php'); ?>
        <br>
        <br>
        <br>
        <br>
        <br>


        <form action="../sql/db_Register.php" enctype="multipart/form-data" method="post">
            <div class="card p-5 box_login">
                <div class="row">
                    <h1>สมัครสมาชิก</h1>
                    <div class="col-md-6 col-6 ">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input name="User" type="text" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input name="Pass" type="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">

                                    <input name="Name" type="text" class="form-control" placeholder="ชื่อ..." required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <input name="Lastname" type="text" class="form-control" placeholder="นามสกุล..." required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <input name="email" type="email" class="form-control" placeholder="อีเมล..." required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-6">
                            <input name="Tel" type="text" class="form-control" placeholder="เบอร์..." required>
                        </div>
                        <div class="mb-3">
                            <div name="Pass" id="emailHelp" class="form-text ms-2 mb-2">รูปโปรไฟล์</div>
                            <input name="IMG_User" type="file" class="form-control" accept="image/*" onchange="loadFile(event)" name="IMG_Product" placeholder="" required> <br>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="Register" class="btn btn-success btn-lg ">ยืนยัน</button>
                            <a href="index.php" class="btn btn-danger btn-lg">ยกเลิก</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-6 img_Register ">
                        <img class="shadow-lg width=" id="output" src="../Asset/img_member/blank-profile.png"> <br>
                    </div>
                </div>
            </div>
        </form>




    </div>

    <script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>


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