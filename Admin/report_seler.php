<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php');
// ค่าวันที่ที่ถูกส่งเข้ามา
$data_date = [
    'date_start' => substr($_POST['dates'], 0, 10),
    'date_end' => substr($_POST['dates'], -10),
];
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- js PDF -->
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <title>Document</title>
</head>

<body>
    <div id="wrapper">
        <div class="row">
            <div class="box_menu_admin">
                <?php require_once('menu.php'); ?>
            </div>
            <div class="box_report overflow-hidden">
                <div class="row">
                    <div class="col text-end me-5 mt-5">
                        <p onclick="Print_PDF()" class="btn btn-warning btn-lg"><i class="far fa-save"></i> PDF </p>
                    </div>
                </div>
                <div class="row ms-5">
                    <div class="col-md-2 ">
                        <input class="form-check-input checkmark" type="radio" name="checker" id="seler" value="seler_items" checked>
                        <label for="seler">ยอดขายสินค้า</label>
                    </div>
                    <div class="col-md-3 ms-1">
                        <input class="form-check-input checkmark" type="radio" name="checker" id="seler_on_off" value="seler_on_off">
                        <label for="seler_on_off">รายได้หน้าร้าน - ออนไลน์</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input checkmark" type="radio" name="checker" id="seler_type" value="seler_type">
                        <label for="seler_type">สินค้าแต่ละประเภท</label>
                    </div>

                    <!-- ค่าวันที่ -->
                    <input type="hidden" id="date_start" value="<?php echo date("Y-m-d", strtotime($data_date['date_start'])) ?>">
                    <input type="hidden" id="date_end" value="<?php echo date("Y-m-d", strtotime($data_date['date_end'])) ?>">

                </div>
                <div id="data_report">
                    <div id="result_report_seler_items"></div>
                    <div id="result_report_seler_on_off"></div>
                    <div id="result_report_seler_type"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function Print_PDF() {
            const data_report = $('#data_report').html();
            html2pdf().from(data_report).save()
        }
    </script>

    <script>
        $(document).ready(function() {
            var data_checkmark = $('input[name="checker"]:checked').val();
            var date_start = $('#date_start').val();
            var date_end = $('#date_end').val();
            // แสดงข้อมูลแต่ขายการยอดขายทั้งหมด
            if (data_checkmark == "seler_items") {
                $.ajax({
                    url: "report_seler_items.php",
                    method: "post",
                    data: {
                        date_start: date_start,
                        date_end: date_end,
                        data_checkmark: data_checkmark
                    },
                    success(data) {
                        $('#result_report_seler_items').html(data).show();
                        $('#result_report_seler_on_off').hide();
                    }
                });
            }
            // ยอดขาย หน้าร้าน - ออนไลน์
            $('.checkmark').change(function() {
                var data_checkmark = $('input[name="checker"]:checked').val();
                var date_start = $('#date_start').val();
                var date_end = $('#date_end').val();
                if (data_checkmark == "seler_items") {
                    $.ajax({
                        url: "report_seler_items.php",
                        method: "post",
                        data: {
                            date_start: date_start,
                            date_end: date_end,
                            data_checkmark: data_checkmark
                        },
                        success(data) {
                            $('#result_report_seler_items').html(data).show();
                            $('#result_report_seler_on_off').hide();
                            $('#result_report_seler_type').hide();
                        }
                    });
                }
                // แสดงข้อมูลแต่ขายการยอดขายทั้งหมด
                if (data_checkmark == "seler_on_off") {
                    $.ajax({
                        url: "repoer_seler_on_off.php",
                        method: "post",
                        data: {
                            date_start: date_start,
                            date_end: date_end,
                            data_checkmark: data_checkmark
                        },
                        success(data) {
                            $('#result_report_seler_on_off').html(data).show();
                            $('#result_report_seler_items').hide();
                            $('#result_report_seler_type').hide();
                        }
                    });
                }
                // แสดงข้อมูลแต่ขายการ ประเภทสินค้า
                if (data_checkmark == "seler_type") {
                    $.ajax({
                        url: "report_seler_type.php",
                        method: "post",
                        data: {
                            date_start: date_start,
                            date_end: date_end,
                            data_checkmark: data_checkmark
                        },
                        success(data) {
                            $('#result_report_seler_type').html(data).show();
                            $('#result_report_seler_on_off').hide();
                            $('#result_report_seler_items').hide();
                        }
                    });
                }
            });

        });
    </script>
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
</body>

</html>