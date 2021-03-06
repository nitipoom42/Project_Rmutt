<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<?php
if ($_SESSION['User'] != "admin") {
    Header("Location:../User/login.php");
}
?>

<!-------------------------------------------------------------------->
<!-- ข้อมูลสิค้าใน stock -->
<?php
$sql_stock = "SELECT * FROM stock as s JOIN type_product as t ON s.TYPE_Product = t.ID_Type_Product";
$stmt_stock = $conn->prepare($sql_stock);
$stmt_stock->execute();
$result_stock = $stmt_stock->fetchAll(PDO::FETCH_ASSOC);
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

    <title>Stock สินค้าทั่วไป</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

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

                <!-- End of Topbar -->
                <div class="alert alert-success text-center" role="alert">
                    <h1>สินค้าทั่วไป</h1>
                </div>
                <div class="row ">
                    <div class="col-md-11 mx-auto card p-2">
                        <table id="stock" class="display ">
                            <thead>
                                <tr>
                                    <th>รูป</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>ราคา</th>
                                    <th>ประเภทสินค้า</th>
                                    <th class="text-center">จำนวนสินค้า</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result_stock as $row_stock) { ?>
                                    <tr>
                                        <td><img src="../Asset/img/<?php echo $row_stock['IMG_Product'] ?>" width="75" height="75"></td>
                                        <td><?php echo $row_stock['NAME_Product'] ?></td>
                                        <td><?php echo $row_stock['PRICE_Product'] ?>.-บาท</td>
                                        <td><?php echo $row_stock['INFO_Type_Product'] ?></td>
                                        <td class="text-center">
                                            <?php if ($row_stock['QTY_Product'] < 20) { ?>
                                                <div class="col-7 mx-auto">
                                                    <div class="alert alert-danger" role="alert">

                                                        <small> สินค้าใกล้หมด <?php echo $row_stock['QTY_Product'] ?></small>


                                                    </div>
                                                </div>

                                            <?php   } ?>
                                            <?php if ($row_stock['QTY_Product'] >= 20) { ?>
                                                <?php echo $row_stock['QTY_Product'] ?> ชิ้น
                                            <?php   } ?>

                                        </td>
                                        <td>
                                            <?php if ($row_stock['Status_Product'] == 1) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    พร้อมขาย
                                                </div>
                                            <?php } ?>
                                            <?php if ($row_stock['Status_Product'] == 2) { ?>
                                                <div class="alert alert-danger text-center" role="alert">
                                                    ยกเลิกการขาย
                                                </div>
                                            <?php } ?>

                                        </td>
                                        <td> <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_product<?php echo $row_stock['ID_Pro'] ?>">แก้ไข</a>

                                        </td>

                                    </tr>

                                    <!-- Modalแก้ไขสินค้า -->
                                    <div class="modal fade" id="edit_product<?php echo $row_stock['ID_Pro'] ?>" tabindex="-1" aria-labelledby="add_type_product" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="add_type_product">แก้ไขข้อมูลสินค้า</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../sql/db_edit_product.php" method="post">
                                                        <div class="card col-md-12 mx-auto p-5 shadow rounded-5">
                                                            <div class="text-center">
                                                                <img src="../Asset/img/<?php echo $row_stock['IMG_Product'] ?>" width="75" height="75">

                                                                <div class="input-group mb-2">
                                                                    <span class="input-group-text" id="basic-addon1">ชื่อสินค้า</span>
                                                                    <input name="NAME_Product" type="text" class="form-control" value="<?php echo $row_stock['NAME_Product'] ?>">
                                                                </div>
                                                                <div class="input-group mb-2">

                                                                    <span class="input-group-text" id="basic-addon1">จำนวนสินค้า</span>
                                                                    <input name="QTY_Product" type="number" class="form-control col-3 text-center" value="<?php echo $row_stock['QTY_Product'] ?>">
                                                                    <span class="input-group-text" id="basic-addon1">ชิ้น</span>
                                                                </div>


                                                                <div class="form-group row">
                                                                    <!-- ประเภทสินค้า -->
                                                                    <label class="form-label me-2">สถานะ :</label>
                                                                    <select name="Status_Product" class="form-select" aria-label="Default select example">
                                                                        <!-- loop ข้อมูลของประเภทของสินค้าจากตาราง type_product มาแเสงใน List รายการ -->
                                                                        <?php
                                                                        foreach ($result_status_product as $row_status_product) { ?>
                                                                            <option class="form-control" value="<?php echo $row_status_product['ID_Status_Product'] ?>"><?php echo $row_status_product['INFO_Status_Product'] ?></option>
                                                                        <?php  } ?>
                                                                    </select>
                                                                </div>

                                                                <input type="hidden" name="ID_Product" value="<?php echo $row_stock['ID_Pro'] ?>">
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button onclick="edit_product()" type="submit" name="edit_product" class="btn btn-success">ตกลง</button>
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
                $('#stock').dataTable({
                    "pageLength": 7,
                    "lengthChange": false,
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


</body>

</html>