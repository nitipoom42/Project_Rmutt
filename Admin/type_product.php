<?php require_once('../sql/connect.php') ?>

<?php
if ($_SESSION['User'] != "admin") {
    Header("Location:../User/login.php");
}
?>

<!-- เรียกข้อมูลประเภทสินค้าจาก ฐานข้อมูล type_product -->
<?php
$sql_fetch_type = "SELECT * FROM type_product";
$smtm_fetch_type = $conn->prepare($sql_fetch_type);
$smtm_fetch_type->execute();
$result_type_product = $smtm_fetch_type->fetchall(PDO::FETCH_ASSOC);
?>

<!-- สถานะสินค้า -->
<?php
$sql_status_product = "SELECT * FROM status_product";
$smtm_status_product = $conn->prepare($sql_status_product);
$smtm_status_product->execute();
$result_status_product = $smtm_status_product->fetchall(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ประเภทสินค้า</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Asset/Bootstrap/css/bootstrap.min.css">
    <script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../Asset/css.css">

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
                <!-- เพิ่มประเภทสินค้า -->
                <!-- Button trigger modal -->

                <div class="row mt-5 ">
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
                                        <div class="mb-3 text-center">
                                            <img class="shadow-lg rounded" width="260" height="250" id="output" src="https://hongthaipackaging.com/wp-content/uploads/2019/04/%E0%B8%81%E0%B8%A5%E0%B9%88%E0%B8%AD%E0%B8%87%E0%B9%80%E0%B8%9A%E0%B8%AD%E0%B8%A3%E0%B9%8C-I-55x45x40-cm-%E0%B8%A2x%E0%B8%81x%E0%B8%AA.jpg">
                                        </div>
                                        <div class="form-group row">
                                            <label class="btn btn-primary mx-auto">
                                                <i class="fa fa-image"></i> เลือกรูปสินค้า<input type="file" style="display: none;" accept="image/*" onchange="loadFile(event)" name="IMG_Type_Product" required>
                                            </label>
                                        </div>
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
                                    <th>รูป</th>
                                    <th>ชื่อประเภทสินค้า</th>
                                    <th>สภานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result_type_product as $row_type) { ?>
                                    <tr>
                                        <td>
                                            <img src="../Asset/img_type_product/<?php echo $row_type['IMG_Type_Product'] ?>" width="75" height="75">
                                        </td>
                                        <td><?php echo $row_type['INFO_Type_Product'] ?></td>
                                        <td>
                                            <?php if ($row_type['Status_Product'] == 1) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    พร้อมขาย
                                                </div>
                                            <?php } ?>
                                            <?php if ($row_type['Status_Product'] == 2) { ?>
                                                <div class="alert alert-danger text-center" role="alert">
                                                    ยกเลิกการขาย
                                                </div>
                                            <?php } ?>
                                        </td>
                                        <td> <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_type_product<?php echo $row_type['ID_Type_Product'] ?>">แก้ไข</a>
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
                                                            <div class="form-group mt-3">
                                                                <!-- ประเภทสินค้า -->
                                                                <label class="form-label">สภานะ:</label>
                                                                <select name="Status_Product" class="form-control ">
                                                                    <!-- loop ข้อมูลของประเภทของสินค้าจากตาราง type_product มาแเสงใน List รายการ -->
                                                                    <?php
                                                                    foreach ($result_status_product as $row_status_product) { ?>
                                                                        <option class="form-control" value="<?php echo $row_status_product['ID_Status_Product'] ?>"><?php echo $row_status_product['INFO_Status_Product'] ?></option>
                                                                    <?php  } ?>
                                                                </select>
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
                    },

                });
            });
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