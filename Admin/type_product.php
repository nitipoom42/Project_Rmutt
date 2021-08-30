<?php require_once('../sql/connect.php') ?>

<!-- เรียกข้อมูลประเภทสินค้าจาก ฐานข้อมูล type_product -->
<?php
$sql_fetch_type = "SELECT * FROM type_product";
$smtm_fetch_type = $conn->prepare($sql_fetch_type);
$smtm_fetch_type->execute();
$result_type_product = $smtm_fetch_type->fetchall(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Asset/Bootstrap/css/bootstrap.min.css">
    <script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>

    <!-- ajax -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- datatables -->
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="js/datatables.min.js"></script>

    <!-- sweetalert -->
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

                <!-- เพิ่มประเภทสินค้า -->

                <!-- Button trigger modal -->

                <div class="row ">
                    <div class="col-md-12 ">
                        <a type="button" class="btn btn-primary ms-5 mb-4" data-bs-toggle="modal" data-bs-target="#add_type_product">
                            เพิ่มประเภทสินค้า
                        </a>
                    </div>
                </div>

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



                <!-- ตารางข้อมูลประเภทสินค้า -->
                <div class="row">
                    <div class="col-md-9 mx-auto card p-2">
                        <table id="type_product" class="display">
                            <thead>
                                <tr>
                                    <th>ชื่อประเภทสินค้า</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result_type_product as $row_type) { ?>
                                    <tr>
                                        <td><?php echo $row_type['INFO_Type_Product'] ?></td>
                                        <td> <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_type_product<?php echo $row_type['ID_Type_Product'] ?>">แก้ไข</a>
                                            <a onclick="del_type(<?php echo $row_type['ID_Type_Product']  ?>) " class="btn btn-danger btn-sm">ลบ</a>
                                        </td>
                                    </tr>

                                    <!-- Modalแก้ไขประเภทสินค้า -->
                                    <div class="modal fade" id="edit_type_product<?php echo $row_type['ID_Type_Product'] ?>" tabindex="-1" aria-labelledby="add_type_product" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="add_type_product">แก้ไขประเภทสินค้า</h5>
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
                                                    <button onclick="edit_type()" type="submit" name="edit_type_product" class="btn btn-success">ตกลง</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>

                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>



            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->


        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

        <!-- sweetalert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                $('#type_product').DataTable({
                    "language": {
                        "lengthMenu": "แสดง _MENU_ แถว",
                        "zeroRecords": "ไม่พบข้อมูล",
                        "info": "แสดงหน้า _PAGE_ จาก _PAGES_ หน้า",
                        "search": "ค้นหา",
                        "infoEmpty": "",
                        "infoFiltered": "",
                    }
                });
            });
        </script>


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


</body>

</html>