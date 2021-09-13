<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<?php
if ($_SESSION['User'] != "admin") {
    Header("Location:../User/login.php");
}
?>
<!-------------------------------------------------------------------->
<?php
$sql_bank = "SELECT * FROM bank";
$stmt_bank = $conn->prepare($sql_bank);
$stmt_bank->execute();
$result_bank = $stmt_bank->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ธนาคาร</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

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
        <div class="fixed-top"> <?php require_once('menu.php') ?></div>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="">
                <!-- End of Topbar -->
                <div class="row mt-5">
                    <div class="col-md-12 btn_add_bank">
                        <button type="button" class="btn btn-primary  " data-bs-toggle="modal" data-bs-target="#add_type_product">
                            เพิ่มบัญชีธนาคาร
                        </button>
                    </div>
                </div>
                <!-- Modalเพิ่มประเภทสินค้า -->
                <div class="modal fade" id="add_type_product" tabindex="-1" aria-labelledby="add_type_product" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add_type_product">เพิ่มบัญชีธนาคาร</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../sql/db_add_bank.php" enctype="multipart/form-data" method="post">
                                    <div class="card col-md-12 mx-auto p-5 shadow rounded-5">
                                        <div class="mb-3 text-center">
                                            <img class="shadow-lg rounded" width="100%" height="200" id="output" src="../Asset/img_pay/logo.jpg">
                                        </div>
                                        <label class="btn btn-primary mx-auto">
                                            <i class="fa fa-image"></i>เลือกรูปภาพ<input type="file" name="IMG_bank" style="display: none;" accept="image/*" onchange="loadFile(event)" required>
                                        </label>
                                        <div class="">
                                            <label class="form-label">เพิ่มบัญชีธนาคาร</label>
                                            <input name="NAME_bank" type="text" class="form-control" placeholder="ธนาคาร...">
                                        </div>
                                        <div class="">
                                            <label class="form-label">เลขบัญชี</label>
                                            <input name="NUM_bank" type="text" class="form-control" placeholder="เลขบัญชี...">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">

                                <button type="submit" name="Add_bank" class="btn btn-success">ยืนยัน</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>


                <div class="row ">
                    <div class="col-md-9 mx-auto card p-2 box_items_bank">
                        <table id="bank" class="display ">
                            <thead>
                                <tr>
                                    <th>รูป</th>
                                    <th>ชื่อธนาคาร</th>
                                    <th>เลขบัญชี</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result_bank as $row_bank) { ?>
                                    <tr>
                                        <td class="text-center ">
                                            <img class="img_bank_admin" src="../Asset/img_bank/<?php echo $row_bank['IMG_bank'] ?>">
                                        </td>

                                        <td><?php echo $row_bank['NAME_bank'] ?></td>
                                        <td><?php echo $row_bank['NUM_bank'] ?></td>

                                        <!-- เรียกข้อมูลประเภทสินค้าจาก ฐานข้อมูล type_product -->
                                        <?php

                                        $data_status_bank = [
                                            'ID_bank' => $row_bank['ID_bank'],
                                        ];

                                        $sql_fetch_type = "SELECT * FROM bank WHERE ID_bank=:ID_bank";
                                        $smtm_fetch_type = $conn->prepare($sql_fetch_type);
                                        $smtm_fetch_type->execute($data_status_bank);
                                        $result_type_product = $smtm_fetch_type->fetchAll(PDO::FETCH_ASSOC);
                                        ?>

                                        <td>
                                            <?php foreach ($result_type_product as $row_status) { ?>
                                                <?php if ($row_status['Status_Product'] == 1) { ?>
                                                    <form action="../sql/db_on_off_bank.php" method="post">
                                                        <input type="hidden" name="ID_bank" value="<?php echo $row_bank['ID_bank'] ?>">
                                                        <button type="submit" name="Status_off" class="btn btn-outline-danger">ปิดการใช้งาน</button>
                                                    </form>
                                                <?php  } ?>
                                                <?php if ($row_status['Status_Product'] == 2) { ?>
                                                    <form action="../sql/db_on_off_bank.php" method="post">
                                                        <input type="hidden" name="ID_bank" value="<?php echo $row_bank['ID_bank'] ?>">
                                                        <button type="submit" name="Status_on" class="btn btn-outline-success">เปิดการใช้งาน</button>
                                                    </form>
                                                <?php  } ?>
                                            <?php  } ?>



                                        </td>

                                    </tr>
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
                $('#bank').dataTable({
                    "pageLength": 2,
                    "lengthChange": false,
                    "language": {
                        "lengthMenu": "แสดง _MENU_ แถว",
                        "zeroRecords": "ไม่พบธนาคาร",
                        "info": "แสดงหน้า _PAGE_ จาก _PAGES_ หน้า",
                        "search": "ค้นหา",
                        "infoEmpty": "",
                        "infoFiltered": "",
                    }
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