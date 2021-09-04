<?php require_once('../sql/connect.php') ?>

<?php
if ($_SESSION['User'] != "admin") {
    Header("Location:../User/login.php");
}
?>

<!-- เรียกข้อมูลประเภทสินค้าจาก ฐานข้อมูล type_product -->
<?php
$sql_fetch_type = "SELECT * FROM type_product WHERE ID_Type_Product=1";
$smtm_fetch_type = $conn->prepare($sql_fetch_type);
$smtm_fetch_type->execute();
$result_type_product = $smtm_fetch_type->fetchall(PDO::FETCH_ASSOC);
?>
<!-------------------------------------------------------------------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>เพิ่มสินค้า</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Asset/css.css">
    <link rel="stylesheet" href="../Asset/Bootstrap/css/bootstrap.min.css">
    <script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>

    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.js" integrity="sha512-dhEwOlXtyz36+QteITRvQOAWr/d8kQKeHs4D/1yttrjtLxDj8qPIkgxYl3hR7NIRZUfZIqEPgTP1DG5AwNU7Jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
</head>

<body id="page-top">
    <?php require_once('../User/alert.php') ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require_once('menu.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="col-md-5 card border-left-primary shadow mx-auto">
                    <form class="user" action="../sql/db_Add_Product_Promotion.php" enctype="multipart/form-data" method="post">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <img class="shadow-lg rounded" width="260" height="250" id="output" src="https://hongthaipackaging.com/wp-content/uploads/2019/04/%E0%B8%81%E0%B8%A5%E0%B9%88%E0%B8%AD%E0%B8%87%E0%B9%80%E0%B8%9A%E0%B8%AD%E0%B8%A3%E0%B9%8C-I-55x45x40-cm-%E0%B8%A2x%E0%B8%81x%E0%B8%AA.jpg">
                            </div>

                            <div class="form-group row">
                                <label class="btn btn-primary mx-auto">
                                    <i class="fa fa-image"></i> เลือกรูปสินค้า<input type="file" style="display: none;" accept="image/*" onchange="loadFile(event)" name="IMG_Product" required>
                                </label>
                            </div>

                            <div class="form-group row">
                                <label class="form-label">ชื่อสินค้า</label>
                                <input name="NAME_Product" type="text" class="form-control form-control-user" placeholder="ชื่อสินค้า..." required>
                            </div>
                            <div class="form-group row">
                                <label class="form-label">ราคาสินค้า</label>
                                <input name="POINT_Product" type="number" class="form-control form-control-user" placeholder="ราคาสินค้า..." required>
                            </div>
                            <div class="form-group row">
                                <label class="form-label">จำนวนสินค้า</label>
                                <input name="QTY_Product" type="number" class="form-control form-control-user" placeholder="จำนวนสิค้า..." required>
                            </div>
                            <div class="form-group row">
                                <!-- ประเภทสินค้า -->
                                <label class="form-label me-2">สินค้าประเภท :</label>
                                <select name="Type_Product" class="form-control ">
                                    <!-- loop ข้อมูลของประเภทของสินค้าจากตาราง type_product มาแเสงใน List รายการ -->
                                    <?php
                                    foreach ($result_type_product as $row_type) { ?>
                                        <option class="form-control" value="<?php echo $row_type['ID_Type_Product'] ?>"><?php echo $row_type['INFO_Type_Product'] ?> </option>
                                    <?php  } ?>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="mx-auto">
                                    <button onclick="add_product() " type="submit" name="Add_Product_Promotion" class="btn btn-success mt-3 mr-5">เพิ่มสินค้า</button>

                                    <a type="reset" href="index.php" class="btn btn-outline-danger mt-3">ยกเลิก</a>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function add_product() {
            Swal.fire({
                icon: 'success',
                title: 'เพิ่มสินค้าสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>

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