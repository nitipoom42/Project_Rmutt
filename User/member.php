<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>
<?php $page = "member" ?>

<!-- ถ้าไม่มีการ Login จะให้เด้งไปที่หน้า Login -->
<?php
if (!$_SESSION['User']) {
    Header("Location:login.php");
}
?>
<?php

$data_member = [
    'id' => $_SESSION['ID_Member'],
];
$sql_member = "SELECT * FROM member WHERE ID_Member=:id";
$stmt_member = $conn->prepare($sql_member);
$stmt_member->execute($data_member);
$result_member = $stmt_member->fetchAll(PDO::FETCH_ASSOC);
?>



<?php
$data_id = [
    'ID_Member' => $_SESSION['ID_Member'],
];
$sql_oder = "SELECT * FROM oder_detail as od
JOIN oder as o ON od.ID_Oder = o.ID_Oder
JOIN stock as s ON od.ID_Product = s.ID_Product
WHERE o.ID_Member=:ID_Member AND s.Status_Product = 1 AND o.oder_status=3
GROUP BY od.ID_Oder ORDER BY od.ID_Oder DESC";
$stmt_oder = $conn->prepare($sql_oder);
$stmt_oder->execute($data_id);
$result_oder = $stmt_oder->fetchAll(PDO::FETCH_ASSOC);
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

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.js" integrity="sha512-dhEwOlXtyz36+QteITRvQOAWr/d8kQKeHs4D/1yttrjtLxDj8qPIkgxYl3hR7NIRZUfZIqEPgTP1DG5AwNU7Jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">

    <title>Home</title>


</head>

<body>
    <div class="container">
        <?php require_once('alert.php'); ?>
        <!-- เมนู -->
        <?php require_once('navbar.php'); ?>
        <br>
        <br>
        <br>
        <br>
        <div class="row">
            <?php
            foreach ($result_member as $row_member) { ?>
                <div class="col member_img text-center">
                    <img class="shadow-lg img-fluid rounded-circle"" src=" ../Asset/img_member/<?php echo $row_member['IMG_User']; ?>">
                </div>
        </div>
        <div class="mt-2 mb-4">

            <div class="row">
                <div class="mt-3  ">
                    <div class="col-xl-6 col-md-6 mb-2 mx-auto ">
                        <div class="card shadow  box_info_member">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5>ชื่อผู้ใช้งาน</h5>
                                        <p class="text-success"> คุณ <?php echo $row_member['Name']  ?> <?php echo $row_member['Lastname']  ?> </p>
                                        <h5>เบอร์โทร</h5>
                                        <p class="text-success"><?php echo $row_member['Tel']  ?> </p>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../sql/db_edit_member.php" method="post">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">ชื่อผู้ใช้งาน</span>
                                                                <input type="text" class="form-control" name="Name" value="<?php echo $row_member['Name']  ?>">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">นามสกุล</span>
                                                                <input type="text" class="form-control" name="Lastname" value="<?php echo $row_member['Lastname']  ?>">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">เบอร์โทร</span>
                                                                <input type="text" class="form-control" name="Tel" value="<?php echo $row_member['Tel']  ?>">
                                                            </div>
                                                            <input type="hidden" class="form-control" name="ID_Member" value="<?php echo $row_member['ID_Member']  ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                        <button type="submit" name="edit_member" class="btn btn-primary">บันทึก</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="">
                    <div class="col-xl-6 col-md-6 mb-4 mx-auto ">
                        <div class="card shadow box_info_member ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-center">
                                        <h5>แต้มสะสมทั้งหมด</h5>
                                        <h1><?php echo number_format($row_member['Point'])  ?></h1>
                                        <h5>แต้ม</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col loguot text-center ">
                    <a href="../sql/db_Logout.php"><small>ออกจากระบบ</small></a>
                </div>
            </div>

        </div>


    <?php } ?>
    <h1>ประวัติการสั่งซื้อ</h1>

    <?php $total = 0; ?>

    <?php foreach ($result_oder as $row_oder) { ?>

        <div class="accordion accordion-flush rounded shadows mt-3 " id="accordionExample">
            <div class="accordion-item rounded">
                <h2 class="accordion-header rounded" id="headingOne<?php echo $row_oder['ID_Oder']; ?>">
                    <button class="accordion-button collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $row_oder['ID_Oder']; ?>" aria-expanded="true" aria-controls="collapseOne">
                        <div class="row align-items-center">
                            <?php
                            $originalDate =  $row_oder['Oder_date'];
                            $newDate = date(" d/m/Y H:i:s ", strtotime($originalDate));
                            echo $newDate;
                            ?>
                        </div>
                    </button>
                </h2>

                <div id="collapseOne<?php echo $row_oder['ID_Oder']; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo $row_oder['ID_Oder']; ?>" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <?php
                        $data_oder_id = [
                            'id' => $row_oder['ID_Oder'],
                        ];

                        $sql_oder_id = "SELECT * FROM oder_detail as o  JOIN stock as s ON o.ID_Product=s.ID_Product
                         WHERE o.ID_Oder=:id AND s.Status_Product = 1";
                        $stmt_oder_id = $conn->prepare($sql_oder_id);
                        $stmt_oder_id->execute($data_oder_id);
                        $result_oder_id = $stmt_oder_id->fetchAll(PDO::FETCH_ASSOC);

                        //สินค้าโปรโมชั่น
                        $sql_oder_id_promotion = "SELECT * FROM oder_detail as o
                                                        JOIN stock_promotion as sp ON o.ID_Product=sp.ID_Product_Promotion  
                                                        WHERE ID_Oder=:id";
                        $stmt_oder_id_promotion = $conn->prepare($sql_oder_id_promotion);
                        $stmt_oder_id_promotion->execute($data_oder_id);
                        $result_oder_id_promotion = $stmt_oder_id_promotion->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php
                        foreach ($result_oder_id as $row_oder_id) { ?>
                            <div class="row align-items-center">
                                <div class="col-md-2"><img src="../Asset/img/<?php echo $row_oder_id['IMG_Product']; ?>" width="100" height="100"></div>
                                <div class="col-md-2"><?php echo $row_oder_id['NAME_Product']; ?></div>
                                <div class="col-md-2"><?php echo $row_oder_id['QTY']; ?></div>
                                <div class="col-md-2"><?php echo $row_oder_id['QTY'] * $row_oder_id['PRICE_Product']; ?> .-บาท</div>
                            </div>
                            <?php
                            $sum = $row_oder_id['QTY'] * $row_oder_id['PRICE_Product'];
                            $total = $total + $sum;
                            ?>
                        <?php    }  ?>
                        <?php
                        foreach ($result_oder_id_promotion as $row_oder_id_promotion) { ?>
                            <div class="row align-items-center">
                                <div class="col-md-2"><img src="../Asset/img/<?php echo $row_oder_id_promotion['IMG_Product']; ?>" width="100" height="100"></div>
                                <div class="col-md-2"><?php echo $row_oder_id_promotion['NAME_Product']; ?></div>
                                <div class="col-md-2"><?php echo $row_oder_id_promotion['QTY']; ?></div>
                                <div class="col-md-2"><?php echo $row_oder_id_promotion['QTY'] * $row_oder_id_promotion['POINT_Product']; ?>.แต้ม</div>
                            </div>
                            <?php
                            $sum = $row_oder_id['QTY'] * $row_oder_id['PRICE_Product'];
                            $total = $total + $sum;
                            ?>
                        <?php    }  ?>
                        <div class="row">
                            <div class="col text-end">
                                <h5>ราคารวมทั้งหมด <?php echo number_format($total, 2) ?>-บาท</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

    <br>
    <br>
    <br>
    <br>

    <?php require_once('menu.php'); ?>

    </div>

</body>

<script src="../Asset/Bootstrap/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "../sql/db_cancel_oder_timeout.php"
        })
    });
</script>

</html>