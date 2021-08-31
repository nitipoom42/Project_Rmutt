<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<!-------------------------------------------------------------------->
<?php
$sql = "SELECT * FROM banner";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <div class="box_menu_admin">
            <?php require_once('menu.php') ?>
        </div>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <div class="row ">
                    <div class="col-md-12 box_banner">
                        <button type="button" class="btn btn-primary ms-5 mb-4" data-bs-toggle="modal" data-bs-target="#add_type_product">
                            เพิ่มแบนเนอร์โปรโมชั่น
                        </button>
                    </div>
                </div>
                <!-- Modalเพิ่มประเภทสินค้า -->
                <div class="modal fade" id="add_type_product" tabindex="-1" aria-labelledby="add_type_product" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add_type_product">แบนเนอร์โปรโมชั่น</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../sql/db_add_banner.php" enctype="multipart/form-data" method="post">
                                    <div class=" card col-md-12 mx-auto p-5 ">
                                        <div class="mb-3 text-center">
                                            <img id="output" src="holder.js/1000x500">
                                        </div>
                                        <label class="btn btn-primary mx-auto">
                                            <i class="fa fa-image mx-auto"></i>เลือกรูปภาพ<input type="file" name="IMG_Banner" style="display: none;" accept="image/*" onchange="loadFile(event)" required>
                                        </label>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="Add_banner" class="btn btn-success">ยืนยัน</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>



                <div class="row ">
                    <div class="col-md-9 mx-auto box_banner_items">
                        <?php
                        foreach ($result as $row) { ?>
                            <div class="IMG_Banner mb-5 text-end">
                                <i onclick=del_promotion(<?php echo $row['ID_Banner'] ?>); class="far fa-times-circle btn_del_banner "></i>
                                <img src="../Asset/img_banner/<?php echo $row['IMG_Banner'] ?>" alt="">
                            </div>

                        <?php } ?>
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

        <script>
            function del_promotion(id) {

                Swal.fire({
                    icon: 'error',
                    title: 'คุณจะลบรายการนี้หรือไม่',
                    confirmButtonText: `<a class="text-light" href="../sql/del.php?ID_Banner=${id}">ยืนยัน</a>`,
                    confirmButtonColor: '#d33',
                    showCancelButton: true,
                    cancelButtonText: `ยกเลิก`,
                    cancelButtonColor: '#188754'

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

        <!-- holder -->
        <script src="../Asset/holder/holder.js"></script>


</body>

</html>