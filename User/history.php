<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php');

?>
<?php $page = "history" ?>
<!-------------------------------------------------------------------->

<!-- ถ้าไม่มีการ Login จะให้เด้งไปที่หน้า Login -->
<?php
if (!$_SESSION['User']) {
    Header("Location:login.php");
}
?>
<?php
$data_id = [
    'ID_Member' => $_SESSION['ID_Member'],
];
// รานการ order สินค้า
$sql_oder = "SELECT * FROM oder as o
INNER JOIN oder_detail as od ON o.ID_Oder = od.ID_Oder
INNER JOIN stock as s ON s.ID_Product = od.ID_Product
WHERE o.ID_Member=:ID_Member AND s.Status_Product =1 AND NOT oder_status=3 
GROUP BY o.ID_Oder";
$stmt_oder = $conn->prepare($sql_oder);
$stmt_oder->execute($data_id);
$result_oder = $stmt_oder->fetchAll(PDO::FETCH_ASSOC);

// สินค้าโปรโมชั่น
$sql_oder_promotion = "SELECT * FROM oder as o
INNER JOIN oder_detail as od ON o.ID_Oder = od.ID_Oder
INNER JOIN stock_promotion as sp ON sp.ID_Product_Promotion = od.ID_Product
WHERE o.ID_Member=:ID_Member AND NOT oder_status=3
GROUP BY o.ID_Oder";
$stmt_oder_promotion = $conn->prepare($sql_oder);
$stmt_oder_promotion->execute($data_id);
$result_oder_promotion = $stmt_oder_promotion->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
$sql = "SELECT * FROM bank WHERE Status_Product=1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result_bank = $stmt->fetchall(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Css -->
    <link rel="stylesheet" href="../Asset/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Asset/css.css">

    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="../Asset/slick/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="../Asset/slick/slick/slick-theme.css" />


    <!-- ajax -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.js" integrity="sha512-dhEwOlXtyz36+QteITRvQOAWr/d8kQKeHs4D/1yttrjtLxDj8qPIkgxYl3hR7NIRZUfZIqEPgTP1DG5AwNU7Jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">


    <title>รายการสั่งซื้อ</title>
</head>

<body>


    <?php require_once('alert.php'); ?>


    <div class="container">


        <?php require_once('navbar.php'); ?>
        <br>
        <br>
        <br>

        <br>

        <?php if (@!$result_oder & @!$result_oder_promotion) { ?>
            <div class="row">
                <div class="col text-center mt-5">
                    <h1><i class="far fa-times-circle mb-5"></i></h1>
                    <h1>ไม่มีรายการที่ต้องชำระเงิน</h1>
                </div>
            </div>
        <?php  } ?>

        <?php foreach ($result_oder as $key => $row_oder) { ?>
            <!-- form ยกเลิกการสั่ง -->
            <form action="../sql/cancel_oder.php" enctype="multipart/form-data" method="post">
                <div class="mt-3 shadow  box_order_member ">
                    <div class="row p-3  text-start">
                        <h5>
                            วันที่สั่งซื้อ
                            <?php
                            $originalDate = $row_oder['Oder_date'];
                            echo  $newDate = date("d/m/Y", strtotime($originalDate));
                            ?>
                            <?php
                            $originalDate = $row_oder['Oder_date'];
                            echo  $newDate = date("H:i:s", strtotime($originalDate));
                            ?>
                        </h5>
                        <?php if ($row_oder['oder_status'] == 0) { ?>
                            <input type="hidden" name="ID_Oder" value="<?php echo $row_oder['ID_Oder']; ?>">
                            <p onclick="del_oder(<?php echo $row_oder['ID_Oder'] ?>)" class="btn btn-outline-danger btn_del_oder"><i class="fas fa-trash-alt"></i></p>
                            <script>
                                function del_oder(id) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: `คุณจะยกเลิกรายการนี้หรือไม่`,
                                        confirmButtonText: `<a class="text-light" href="../sql/cancel_oder.php?cancel_oder=${id}">ยืนยัน</a>`,
                                        confirmButtonColor: '#d33',
                                        showCancelButton: true,
                                        cancelButtonText: `ยกเลิก`,
                                        cancelButtonColor: '#188754'
                                    });
                                }
                            </script>

                        <?php  } ?>



                    </div>

                    <div class="row  text-center">
                        <div class="row mb-2">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">ชื่อสินค้า</div>
                            <div class="col-md-2">จำนวน</div>
                            <div class="col-md-2">ราคา</div>
                        </div>

                        <?php
                        $data_oder_id = [
                            'id' => $row_oder['ID_Oder'],
                        ];

                        $sql_oder_id = "SELECT * FROM oder_detail as o
                    JOIN stock as s ON o.ID_Product=s.ID_Product  
                    WHERE o.ID_Oder=:id AND s.Status_Product = 1";
                        $stmt_oder_id = $conn->prepare($sql_oder_id);
                        $stmt_oder_id->execute($data_oder_id);
                        $result_oder_id = $stmt_oder_id->fetchAll(PDO::FETCH_ASSOC);

                        // สินค้าโปรโมชั่น
                        $sql_oder_id_promotion = "SELECT * FROM oder_detail as o
                    JOIN stock_promotion as sp ON o.ID_Product=sp.ID_Product_Promotion  
                    WHERE ID_Oder=:id ";
                        $stmt_oder_id_promotion = $conn->prepare($sql_oder_id_promotion);
                        $stmt_oder_id_promotion->execute($data_oder_id);
                        $result_oder_id_promotion = $stmt_oder_id_promotion->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php
                        $total = 0;
                        foreach ($result_oder_id as $row_oder_id) { ?>
                            <div class="row align-items-center mb-1 mt-1 ">
                                <div class="col-md-2 "><img src="../Asset/img/<?php echo $row_oder_id['IMG_Product']; ?>" width="100" height="100"></div>
                                <div class="col-md-2"><?php echo $row_oder_id['NAME_Product']; ?></div>
                                <div class="col-md-2"><?php echo $row_oder_id['QTY']; ?></div>
                                <div class="col-md-2"><?php echo $row_oder_id['QTY'] * $row_oder_id['PRICE_Product']; ?> .-บาท</div>
                            </div>
                            <?php
                            $sum = $row_oder_id['QTY'] * $row_oder_id['PRICE_Product'];
                            $total = $total + $sum;
                            ?>
                        <?php } ?>
                        <!-- สินค้าโปรโมชั่น -->
                        <?php
                        foreach ($result_oder_id_promotion as $row_oder_id_promotion) { ?>
                            <div class="row align-items-center mb-2 mt-2 ">
                                <div class="col-md-2 "><img src="../Asset/img_promotion/<?php echo $row_oder_id_promotion['IMG_Product']; ?>" width="100" height="100"></div>
                                <div class="col-md-2"><?php echo $row_oder_id_promotion['NAME_Product']; ?></div>
                                <div class="col-md-2"><?php echo $row_oder_id_promotion['QTY']; ?></div>
                                <div class="col-md-2"><?php echo $row_oder_id_promotion['QTY'] * $row_oder_id_promotion['POINT_Product']; ?> แต้ม</div>
                            </div>

                        <?php    }  ?>
                    </div>
                    <div class="row">
                        <div class="col text-end me-2">
                            <?php
                            $potin = $total;
                            $Point =  $potin / 3.33;
                            ?>
                            <h5>ได้รับแต้ม <?php echo number_format($Point) ?> แต้ม</h5>
                            <h5>ราคารวมทั้งหมด <?php echo number_format($total, 2) ?>.-บาท</h5>
                        </div>
                    </div>
                    <div class="row  ">
                        <div class="col-8 mx-auto text-center">
                            <?php
                            if ($row_oder['oder_status'] == 0) { ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="col-12 btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row_oder['ID_Oder']; ?>">
                                    แจ้งชำระเงิน
                                </button>
                            <?php } ?>
                            <?php if ($row_oder['oder_status'] == 0) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <div class="spinner-border text-danger me-2">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    กรุณาแจ้งชำระเงิน ก่อนเวลา <?php echo date("H:i:s", strtotime('+30 minutes', strtotime($row_oder['Oder_date'], 10))); ?> น.
                                </div>
                            <?php } ?>
                            <?php if ($row_oder['oder_status'] == 1) { ?>
                                <div class="alert alert-warning" role="alert">
                                    <div class="spinner-border text-warning" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    กำลังดำเนินการ กรุณารอสักครู่
                                </div>

                            <?php } ?>

                            <?php if ($row_oder['oder_status'] == 2) { ?>
                                <div class="alert alert-success" role="alert">
                                    <div class="spinner-border text-success" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    กรุณาไปรับสินค้า
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?php echo $row_oder['ID_Oder']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แจ้งชำระเงิน</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../sql/db_confirm_pay.php" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <div id="logo_bank<?php echo $row_oder['ID_Oder'] ?>" class="img_bank">
                                            <img class="" src="../Asset/img_pay/logo.jpg">
                                        </div>
                                        <div id="show<?php echo $row_oder['ID_Oder'] ?>" class="mb-2"></div>

                                        <div class="input-group mb-2">
                                            <!-- ประเภทสินค้า -->
                                            <label class="input-group-text" for="inputGroupSelect02">ธนาคาร</label>
                                            <select id="bank<?php echo $row_oder['ID_Oder'] ?>" name="NAME_bank" class="form-select">
                                                <!-- loop ข้อมูลของประเภทของสินค้าจากตาราง type_product มาแเสงใน List รายการ -->
                                                <option class=" form-control" value="" selected disabled>--- กรุณาเลือกช่องทางชำระเงิน --- </option>
                                                <?php
                                                foreach ($result_bank as $row_bank) { ?>
                                                    <option class="form-control" value="<?php echo $row_bank['ID_bank'] ?>">ธนาคาร <?php echo $row_bank['NAME_bank'] ?> </option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="mb-2  img_pay mx-auto">
                                            <img id="output<?php echo $row_oder['ID_Oder'] ?>" src="../Asset/img_pay/pay.png">
                                        </div>
                                        <input class="form-control" name="IMG_Pay" type="file" accept="image/*" onchange="loadFile<?php echo $row_oder['ID_Oder'] ?>(event)">
                                        <div id="emailHelp" class="form-text">*กรุณาโอนเงินตามจำนวนให้ถูกต้อง*</div>
                                        <div id="emailHelp" class="form-text">*ไม่คืนเงินทุกกรณี*</div>
                                        <hr>
                                        <h5 class="mb-1 text-danger">ราคาทั้งหมด <?php echo number_format($total, 2) ?>-บาท</h5>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="ID_Oder" value="<?php echo $row_oder['ID_Oder'] ?>">
                            <input type="hidden" name="Point" value="<?php echo $Point ?>">
                            <button type="submit" name="confirm_pay" class="btn btn-success">ยืนยันการชำระเงิน</button>
                            <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- แสดงรูปภาพอัตโนมัติ  โดยใน file ต้องมี accept="image/*" onchange="loadFile(event)" ละที่แสดงรูปโดยอ้างอิง ID output ของ div-->
            <script>
                var loadFile<?php echo $row_oder['ID_Oder'] ?> = function(event) {
                    var output<?php echo $row_oder['ID_Oder'] ?> = document.getElementById('output<?php echo $row_oder['ID_Oder'] ?>');
                    output<?php echo $row_oder['ID_Oder'] ?>.src = URL.createObjectURL(event.target.files[0]);
                    output<?php echo $row_oder['ID_Oder'] ?>.onload = function() {
                        URL.revokeObjectURL(output<?php echo $row_oder['ID_Oder'] ?>.src) // free memory
                    }
                };
            </script>


            <script>
                $(document).ready(function() {
                    $('#bank<?php echo $row_oder['ID_Oder'] ?>').change(function() {
                        var ID_P = $('#bank<?php echo $row_oder['ID_Oder'] ?>').val();
                        $.ajax({
                            url: "../sql/select_pay.php",
                            method: "post",
                            data: {
                                ID: ID_P
                            },
                            success(data) {
                                $('#show<?php echo $row_oder['ID_Oder'] ?>').html(data);
                                $('#logo_bank<?php echo $row_oder['ID_Oder'] ?>').hide();
                            }
                        });
                    });
                    $.ajax({
                        url: "../sql/db_cancel_oder_timeout.php"
                    })
                });
            </script>

        <?php } ?>
    </div>




    <br>
    <br>
    <br>
    <br>



    <?php require_once('menu.php'); ?>
    </div>

    <script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>


    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>