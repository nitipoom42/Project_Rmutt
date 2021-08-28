<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<!-- เรียกข้อมูลประเภทสินค้าตาราง type_product-->
<?php
$sql_fetch_type = "SELECT  * FROM type_product;";
$smtm_fetch_type = $conn->prepare($sql_fetch_type);
$smtm_fetch_type->execute();
$result_type = $smtm_fetch_type->fetchAll(PDO::FETCH_ASSOC);
?>



<div class="row  mt-3  text-center  ">
    <hr>
    <?php foreach ($result_type as $type_product) { ?>
        <div class="col-md-4 col-3 mb-3">
            <a class="btn btn-info btn-lg rounded" href="product_full.php?ID_Type_Product=<?php echo $type_product['ID_Type_Product']; ?>   "> <?php echo $type_product['INFO_Type_Product']; ?></a>
        </div>
    <?php } ?>
    <hr>
</div>