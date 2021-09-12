<?php
require_once('../sql/connect.php');
?>
<?php
if ($_SESSION['User'] != "admin") {
    Header("Location:../User/login.php");
}
?>
<!-- รายการสั่งซื้อที่รอจัดเตรียมสินค้า  _S==1 -->
<?php
$sql_oder_s1 = "SELECT * FROM oder WHERE oder_status=1";
$stmt_oder_s1 = $conn->prepare($sql_oder_s1);
$stmt_oder_s1->execute();
$result_oder_s1 = $stmt_oder_s1->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- รายการสั่งซื้อที่รอลูกค้ามารับสินค้า _S==2 -->
<?php
$sql_oder_s2 = "SELECT * FROM oder WHERE oder_status=2";
$stmt_oder_s2 = $conn->prepare($sql_oder_s2);
$stmt_oder_s2->execute();
$result_oder_s2 = $stmt_oder_s2->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- ยอดขายที่ได้จากการสั่งออนไลน์ -->
<?php
$sql_oder_s3 = "SELECT *  ,SUM(od.QTY) as sumQTY ,
SUM(od.QTY*s.PRICE_Product) as sumPriec,
SUM(od.QTY*s.Cost_PRICE_Product) as sumCost
FROM oder as o
JOIN oder_detail as od ON o.ID_Oder = od.ID_Oder
JOIN stock as s ON od.ID_Product=s.ID_Product  
WHERE o.oder_status=3  AND s.Status_Product = 1
GROUP BY date(o.Oder_date), o.oder_status ,s.ID_Product;
";
$stmt_oder_s3 = $conn->prepare($sql_oder_s3);
$stmt_oder_s3->execute();
$result_oder_s3 = $stmt_oder_s3->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- ยอดขายที่ได้จากหน้าร้าน-->
<?php
$sql_oder_s4 = "SELECT *  ,SUM(od.QTY) as sumQTY ,
SUM(od.QTY*s.PRICE_Product) as sumPriec,
SUM(od.QTY*s.Cost_PRICE_Product) as sumCost
FROM oder as o
JOIN oder_detail as od ON o.ID_Oder = od.ID_Oder
JOIN stock as s ON od.ID_Product=s.ID_Product  
WHERE o.oder_status=4  AND s.Status_Product = 1
GROUP BY date(o.Oder_date), o.oder_status ,s.ID_Product;
";
$stmt_oder_s4 = $conn->prepare($sql_oder_s4);
$stmt_oder_s4->execute();
$result_oder_s4 = $stmt_oder_s4->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- สินค้าใกล้หมด-->
<?php
$sql_stock_out = "SELECT * FROM stock WHERE QTY_Product<20;";
$stmt_stock_out = $conn->prepare($sql_stock_out);
$stmt_stock_out->execute();
$result_stock_out = $stmt_stock_out->fetchAll(PDO::FETCH_ASSOC);
?>






<?php ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>รายงานยอดขาย</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Asset/Bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="../Asset/css.css">

    <!-- ajax -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.js" integrity="sha512-dhEwOlXtyz36+QteITRvQOAWr/d8kQKeHs4D/1yttrjtLxDj8qPIkgxYl3hR7NIRZUfZIqEPgTP1DG5AwNU7Jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">

    <!-- กราฟ -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


</head>

<body id="page-top">




    <?php require_once('../User/alert.php') ?>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="box_menu_admin">
            <div id="menu"></div>
        </div>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content ">
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="row">
                    <div class="col-1 me-5"></div>
                    <div class="col-10 ms-2">
                        <div class="container-fluid">
                            <!-- ป้ายแจ้งเตือนจำนวนรายการ -->
                            <div class="row mt-2">
                                <!-- ยอดขายออนไลน์ -->
                                <!-- <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success border-bottom-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2 text-center">
                                                    <div class="text-xs font-weight-bold text-success mb-1">
                                                        <h4>&#3647; ยอดขายออนไลน์</h4>
                                                    </div>
                                                    <?php $sell_total_online = 0; ?>
                                                    <div class="h4 mb-0 text-gray-800">
                                                        <?php foreach ($result_oder_s3 as $total_sell) { ?>
                                                            <?php
                                                            $sum_total_online = $total_sell['sumPriec'] - $total_sell['sumCost'];

                                                            $sell_total_online = $sell_total_online + $sum_total_online;
                                                            ?>
                                                        <?php } ?> <?php echo $sell_total_online; ?>.-บาท</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- ยอดขายหน้าร้าน -->
                                <!-- <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success border-bottom-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2 text-center">
                                                    <div class="text-xs font-weight-bold text-success mb-1">
                                                        <h4>&#3647; ยอดขายหน้าร้าน</h4>
                                                    </div>
                                                    <?php $sell_total_sell = 0; ?>
                                                    <div class="h4 mb-0 text-gray-800">
                                                        <?php foreach ($result_oder_s4 as $total_sell_s4) { ?>
                                                            <?php
                                                            $sum_total_sell = $total_sell_s4['sumPriec'] - $total_sell_s4['sumCost'];
                                                            $sell_total_sell = $sell_total_sell + $sum_total_sell;
                                                            ?>
                                                        <?php } ?> <?php echo $sell_total_sell; ?>.-บาท</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- จัดเตรียมสินค้า -->
                                <!-- <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-danger border-bottom-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2 text-center">
                                                    <div class="text-xs font-weight-bold text-danger mb-1">
                                                        <h4><i class="fas fa-exclamation-triangle"></i> จัดเตรียมสินค้า</h4>
                                                    </div>
                                                    <div class="h4 mb-0 text-gray-800"> <?php echo $stmt_oder_s1->rowCount() ?> รายการ</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- รอลูกค้ามารับสินค้า -->
                                <!-- <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning border-bottom-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2 text-center">
                                                    <div class="text-xs font-weight-bold text-warning mb-1">
                                                        <h4><i class="fas fa-exclamation-circle"></i> รอลูกค้ามารับสินค้า</h4>
                                                    </div>
                                                    <div class="h4 mb-0 text-gray-800"> <?php echo $stmt_oder_s2->rowCount() ?> รายการ</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- สินค้าใกล้หมด -->
                                <!-- <div class="col-xl-3 col-md-6 mb-4 btn-group dropend"> -->
                                <!-- Default dropend button -->
                                <!-- <div class="btn " data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="card border-left-warning border-bottom-warning shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2 text-center">
                                                        <div class="text-xs font-weight-bold text-warning mb-1">
                                                            <h4><i class="fas fa-exclamation-circle"></i> สินค้าใกล้หมด</h4>
                                                        </div>
                                                        <div class="h4 mb-0 text-gray-800"> <?php echo $stmt_stock_out->rowCount() ?> รายการ</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                <!-- </div>
                                    <ul class="dropdown-menu">
                                        <?php foreach ($result_stock_out as $row_stock_out) { ?>
                                            <div class="row">
                                                <div class="col ms-3">
                                                    <small><?php echo $row_stock_out['NAME_Product'] ?></small>
                                                </div>
                                            </div>
                                        <?php   } ?>
                                    </ul>
                                </div> -->

                            </div>

                            <!-- Content Row -->

                            <div class="row">

                                <!-- กราฟ -->
                                <div class="row">
                                    <!-- ปุ่มเลือกวันที่ -->
                                    <div class="col-3">
                                        <form id="from_date" action="report_seler.php" method="post">
                                            <div class="row">
                                                <div class="col btn_out_report">
                                                    <p id="report" class="btn btn-success" name="report">ออกรายงาน</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-week"></i></span>
                                                        <input type="text" class="form-control" name="dates" id="date_select" value="" />
                                                    </div>

                                                </div>


                                            </div>

                                        </form>
                                    </div>
                                    <!-- ปุ่มกดดูรายงาน PDF -->

                                </div>
                                <div class="row">
                                    <div id="result_date"></div>
                                </div>
                            </div>
                            <!-- /.container-fluid -->
                        </div>

                    </div>
                </div>

                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>
        <script src="../Asset/Bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src=" vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>
        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
        <!-- sweetalert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <!-- time -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#menu').load('menu.php');
                setInterval(function() {
                    $('#menu').load('menu.php');
                }, 1000)

                $('#date_select').change(function() {
                    var date_select = $('#date_select').val();
                    $.ajax({
                        url: "../sql/db_slect_graph.php",
                        method: "post",
                        data: {
                            date_select: date_select,
                        },
                        success(data) {
                            $('#result_date').html(data);
                        }
                    });
                });
                $("#report").click(function() {
                    $("#from_date").submit();
                });
            });
        </script>

        <script>
            $(function() {
                $('input[name="dates"]').daterangepicker({
                    "locale": {
                        "format": "YYYY/MM/DD",
                        "separator": " ",
                    },
                    "singleDatePicker": false,
                });
            });
        </script>
</body>

</html>