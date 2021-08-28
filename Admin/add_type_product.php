<?php require_once('../sql/connect.php') ?>

<!-- เรียกข้อมูลประเภทสินค้าจาก ฐานข้อมูล type_product -->
<?php
$sql_fetch_type = "SELECT * FROM type_product";
$smtm_fetch_type = $conn->prepare($sql_fetch_type);
$smtm_fetch_type->execute();
$result_type_product = $smtm_fetch_type->fetchall(PDO::FETCH_ASSOC);
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
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.js" integrity="sha512-dhEwOlXtyz36+QteITRvQOAWr/d8kQKeHs4D/1yttrjtLxDj8qPIkgxYl3hR7NIRZUfZIqEPgTP1DG5AwNU7Jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">


    <title>Admin</title>
</head>

<body>

    <div class="row">

        <div class="col-md-2 col-4 col-sm-4 ">
            <div id="menu"></div>
        </div>

        <div class="col-md-10 col-8 col-sm-8">

            <div class="row mt-5">
                <div class="col-md-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_type_product">
                        เพิ่มประเภทสินค้า
                    </button>
                    <!-- Modalเพิ่มประเภทสินค้า -->
                    <div class="modal fade" id="add_type_product" tabindex="-1" aria-labelledby="add_type_product" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add_type_product">เพิ่มประเภทสินค้า</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../sql/db_add_type_product.php" enctype="multipart/form-data" method="post">
                                        <div class="card col-md-12 mx-auto p-5 shadow rounded-5">
                                            <div class="">
                                                <label class="form-label">ประเภทสินค้า</label>
                                                <input name="NAME_Type_Product" type="text" class="form-control" placeholder="ชื่อประเภทสินค้า...">
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">

                                    <button type="submit" name="Add_Type_Product" class="btn btn-success">ยืนยัน</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>


            <div class="row col-md-12 col-12 col-sm-12 mt-3 p-2 text-center box_cart  shadow align-items-center">

                <div class="col-md-2 col-3 ">
                    ลำดับ
                </div>
                <div class="col-md-3 col-5 ">
                    ประเภทสินค้า
                </div>
                <div class="col-md-3 col-2 ">
                    แก้ไข
                </div>
                <div class="col-md-3 col-2 ">
                    ลบ
                </div>


            </div>
            <?php

            foreach ($result_type_product as $row_type) { ?>
                <div class="row col-md-12 col-12 col-sm-12 mt-3 p-1 text-center box_cart  shadow align-items-center">

                    <div class="col-md-2 col-3 ">
                        <?php echo $row_type['ID_Type_Product'] ?>
                    </div>
                    <div class="col-md-3 col-5 ">
                        <?php echo $row_type['INFO_Type_Product'] ?>
                    </div>
                    <div class="col-md-3 col-2 ">
                        <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_type_product<?php echo $row_type['ID_Type_Product'] ?>">แก้ไข</a>
                    </div>
                    <div class="col-md-3 col-2 ">
                        <a onclick="del_type(<?php echo $row_type['ID_Type_Product']  ?>) " class="btn btn-danger btn-sm">ลบ</a>
                    </div>
                </div>

                <!-- Modalแก้ไขประเภทสินค้า -->
                <div class="modal fade" id="edit_type_product<?php echo $row_type['ID_Type_Product'] ?>" tabindex="-1" aria-labelledby="add_type_product" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add_type_product">เพิ่มประเภทสินค้า</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../sql/db_edit_type_product.php" method="post">
                                    <div class="card col-md-12 mx-auto p-5 shadow rounded-5">
                                        <div class="">
                                            <label class="form-label">ประเภทสินค้า</label>
                                            <input name="INFO_Type_Product" type="text" class="form-control" value="<?php echo $row_type['INFO_Type_Product'] ?>">
                                            <input type="hidden" name="ID_Type_Product" value="<?php echo $row_type['ID_Type_Product'] ?>">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="edit_type_product" class="btn btn-success">ตกลง</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>

                            </div>
                        </div>
                        </form>
                    </div>
                </div>


            <?php   } ?>
        </div>
    </div>






    <!-- Bootstrap -->
    <script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function del_type(id) {
            Swal.fire({
                icon: 'error',
                title: 'คุณจะลบรายการนี้หรือไม่',
                confirmButtonText: `<a class="text-light" href="../sql/del.php?ID_Type_Product=${id}">ยืนยัน</a>`,
                confirmButtonColor: '#d33',
                showCancelButton: true,
                cancelButtonText: `ยกเลิก`,
                cancelButtonColor: '#188754'
            })
        }
    </script>

    <script>
        $(document).ready(function() {
            setInterval(function() {
                $('#menu').load('menu.php');
            }, 1000);
        });
    </script>

</body>



</html>