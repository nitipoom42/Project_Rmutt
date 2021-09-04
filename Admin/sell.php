<?php
require_once('../sql/connect.php');
?>
<?php
if ($_SESSION['User'] != "admin") {
    Header("Location:../User/login.php");
}
?>

<?php

$data_cart_sell = [
    'ID_Member' => $_SESSION['ID_Member']
];

$sql_cart_sell = "SELECT * ,SUM(c.QTY) as QTY FROM cart as c
JOIN stock as s ON  c.ID_Product=s.ID_Product
JOIN type_product as t ON s.TYPE_Product = t.ID_Type_Product
WHERE ID_Member=:ID_Member
GROUP BY c.ID_Product";
$stmt_cart_sell = $conn->prepare($sql_cart_sell);
$stmt_cart_sell->execute($data_cart_sell);
$result_cart_sell = $stmt_cart_sell->fetchAll(PDO::FETCH_ASSOC);
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

    <link rel="stylesheet" href="../Asset/css.css">

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

        <div id="menu"></div>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <div id="sell">
                    <div class="row ms-2 mt-5">
                        <div class="col-5 input-group">
                            <span class="input-group-text">รหัสสินค้า</span>
                            <input class="form-control col-4" autofocus name="ID_Product" id="Select_ID_Product" placeholder="รหัสสินค้า...">
                        </div>
                    </div>
                    <div class="row ms-2 mt-2">
                        <div class="col-5 ms-2 mt-3 box_sell_product">
                            <div class="row mb-4 mt-2 justify-content-center text-center">
                                <div class="col-1 h4">ลำดับ</div>
                                <div class="col-3 h4">รูป</div>
                                <div class="col-4 h4 text-start">ชื่อสินค้า</div>
                                <div class="col-2 h4">จำนวน</div>
                                <div class="col-2 h4">ราคา</div>
                            </div>
                            <?php
                            $total = 0;
                            foreach ($result_cart_sell as $row_cart_sell) { ?>
                                <div class="row justify-content-center text-center align-items-center mt-2 ">
                                    <div class="col-1"></div>
                                    <div class="col-3"> <img width="65" height="65" src="../Asset/img/<?php echo $row_cart_sell['IMG_Product']; ?>"></div>
                                    <div class="col-4 text-start"> <?php echo $row_cart_sell['NAME_Product']; ?> </div>
                                    <div class="col-2"> <?php echo $row_cart_sell['QTY']; ?> </div>
                                    <div class="col-2"> <?php echo $row_cart_sell['QTY'] *  $row_cart_sell['PRICE_Product'] ?>.-บาท </div>
                                </div>
                                <?php
                                $sum = $row_cart_sell['QTY'] *  $row_cart_sell['PRICE_Product'];
                                $total = $total + $sum;
                                ?>
                            <?php } ?>
                        </div>
                        <div class="col-2 text-center box_payment">
                            <h4 class="text-start">ราคาทั้งหมด <?php echo $total; ?>.-บาท</h4>
                            <button class="btn btn-success btn-lg col-12 confirm_sell">ชำระเงิน</button>
                        </div>
                    </div>

                </div>




            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

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


        <script>
            $(document).ready(function() {
                $('#menu').load('menu.php');
                $("#Select_ID_Product").focus();

                $('#Select_ID_Product').change(function() {
                    var ID_Product = $('#Select_ID_Product').val();
                    console.log(ID_Product);

                    $.ajax({
                        url: "../sql/db_Add_cart_sell.php",
                        method: "post",
                        data: {
                            ID_Product: ID_Product
                        },
                        success() {
                            ID_Product = $('#Select_ID_Product').val("");

                            $('#sell').load('sell.php');
                        }
                    });
                });

                $('.confirm_sell').click(function() {
                    $.ajax({
                        url: "../sql/confirm_sell.php",
                        success() {
                            $('#sell').load('sell.php');
                            Swal.fire({
                                title: 'ทำรายการสำเร็จ',
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton: false,

                            })
                        }
                    });
                });
            });
        </script>



</body>

</html>