<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<!-------------------------------------------------------------------->
<?php

$sql_oder = "SELECT * FROM oder_detail as od
JOIN oder as o ON od.ID_Oder = od.ID_Oder

JOIN stock as s ON s.ID_Product = od.ID_Product
WHERE o.oder_status=0 OR o.oder_status=1 OR o.oder_status=2
GROUP BY o.ID_Oder";
$stmt_oder = $conn->prepare($sql_oder);
$stmt_oder->execute();
$result_oder = $stmt_oder->fetchAll(PDO::FETCH_ASSOC);

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

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

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

                <div class="row">
                    <div class="col-md-11 mx-auto card p-2">
                        <table id="oder" class="display">
                            <thead>
                                <tr>
                                    <th>เลขที่ สั่งซื้อ</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; ?>
                                <?php foreach ($result_oder as $row_oder) { ?>

                                    <?php if ($row_oder['oder_status'] == 1 or $row_oder['oder_status'] == 2) { ?>
                                        <tr>
                                            <td><?php echo $row_oder['Oder_date']; ?></td>
                                            <td>
                                                <div class="row align-items-center">
                                                    <div class="col-md-3">
                                                        <?php if ($row_oder['oder_status'] == 1) { ?>
                                                            <div class="alert alert-danger mt-3">
                                                                กรุณาจัดเตรียมสินค้า
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row_oder['oder_status'] == 2) { ?>
                                                            <div class="alert alert-warning mt-3">
                                                                รอลูกมารับสินค้า
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2 text-center">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#oder<?php echo $row_oder['ID_Oder']; ?>">
                                                            <i class="fas fa-receipt"></i> รายระเอียด
                                                        </button>
                                                    </div>

                                                    <!-- ปุ่มยืนยันการรับสินค้า -->
                                                    <div class="col-md-3">

                                                        <?php if ($row_oder['oder_status'] == 1) { ?>
                                                            <form action="../sql/db_admin_confirm_pay.php" method="post">
                                                                <input type="hidden" name="ID_Oder" value="<?php echo $row_oder['ID_Oder'] ?>">
                                                                <input type="hidden" name="ID_Member" value="<?php echo $row_oder['ID_Member'] ?>">
                                                                <button type="submit" name="admin_confirm_pay" class="btn btn-outline-success">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>
                                                        <?php } ?>
                                                        <?php if ($row_oder['oder_status'] == 2) { ?>
                                                            <form action="../sql/db_admin_confirm_pick_up.php" method="post">
                                                                <input type="hidden" name="ID_Oder" value="<?php echo $row_oder['ID_Oder'] ?>">
                                                                <input type="hidden" name="ID_Member" value="<?php echo $row_oder['ID_Member'] ?>">
                                                                <button type="submit" name="admin_confirm_pick_up" class="btn btn-outline-success">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- รายระเอียดการสั่งสินค้า -->
                                        <div class="modal fade " id="oder<?php echo $row_oder['ID_Oder']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">รายการละเอียด</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body overflow-hidden">
                                                        <div class="row ">
                                                            <div class="col-6 mb-3">
                                                                <div class="modal-header">
                                                                    <div class="col-md-3">


                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <h5>ชื่อสินค้า</h5>

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <h5>
                                                                            จำนวน
                                                                        </h5>

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <h5>ราคา</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="modal-header ">
                                                                    <h5>ใบเสร็จชำระเงิน <i class="fas fa-money-bill-wave"></i></h5>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- แสดงข้อมูลสินค้าเฉพาะออเดอร์บิลนั้นๆ   -->
                                                        <?php
                                                        $data_oder_id = [
                                                            'id' => $row_oder['ID_Oder'],
                                                        ];

                                                        $sql_oder_id = "SELECT * FROM oder_detail as o  JOIN stock as s ON o.ID_Product=s.ID_Product  WHERE ID_Oder=:id";
                                                        $stmt_oder_id = $conn->prepare($sql_oder_id);
                                                        $stmt_oder_id->execute($data_oder_id);
                                                        $result_oder_id = $stmt_oder_id->fetchAll(PDO::FETCH_ASSOC);
                                                        ?>




                                                        <div class="row">
                                                            <div class="col-6">
                                                                <?php
                                                                foreach ($result_oder_id as $row_oder_id) { ?>
                                                                    <div class="row mb-4 justify-content align-items-center">
                                                                        <div class="col-3">
                                                                            <img class="img-fluid" src="../Asset/img/<?php echo $row_oder_id['IMG_Product']; ?>" alt="">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <?php echo $row_oder_id['NAME_Product']; ?>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <?php echo $row_oder_id['QTY']; ?>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <?php echo $row_oder_id['PRICE_Product']; ?>.-บาท
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php
                                                                $sum = $row_oder_id['QTY'] * $row_oder_id['PRICE_Product'];
                                                                $total = $total + $sum;
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col text-end mr-4">
                                                                        <h5>ราคารวมทั้งหมด <?php echo number_format($total, 2) ?>.-บาท</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <?php
                                                                $data_pay = [
                                                                    'ID_Oder' => $row_oder['ID_Oder'],
                                                                    'ID_Member' => $row_oder['ID_Member'],
                                                                ];
                                                                $sql_pay = "SELECT * FROM pay as p 
                                                                JOIN member as m ON m.ID_Member = p.ID_Member
                                                                WHERE ID_Oder=:ID_Oder AND p.ID_Member=:ID_Member";
                                                                $stmt_pay = $conn->prepare($sql_pay);
                                                                $stmt_pay->execute($data_pay);
                                                                $result_pay = $stmt_pay->fetchAll(PDO::FETCH_ASSOC);
                                                                ?>
                                                                <?php
                                                                foreach ($result_pay as $row_pay) { ?>
                                                                    <div class="row">
                                                                        <div class="col text-center">
                                                                            <img src="../Asset/img_pay/<?php echo $row_pay['IMG_Pay'] ?>" width="300" height="400">
                                                                            <div class="row text-start">
                                                                                <div class="col ml-5 mt-2">
                                                                                    <div class="alert alert-info" role="alert">
                                                                                        <p>ชื่อลูกค้า : <?php echo $row_pay['Name'] ?></p>
                                                                                        <p>เบอร์ติดต่อ : <?php echo $row_pay['Tel'] ?></p>
                                                                                    </div>

                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <hr>

                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
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
                $('#oder').dataTable({

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