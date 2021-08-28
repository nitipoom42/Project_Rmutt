<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>

<!-- เรียกข้อมูลประเภทสินค้าตาราง type_product-->
<?php
$sql_fetch_type = "SELECT  * FROM type_product;";
$smtm_fetch_type = $conn->prepare($sql_fetch_type);
$smtm_fetch_type->execute();
$result_type = $smtm_fetch_type->fetchAll(PDO::FETCH_ASSOC);
?>



<?php
// loopข้อมูลประเภทของสินค้า
foreach ($result_type as $row_result_type_ID) { ?>
    <div class="bg-light p-3 mt-3 rounded">
        <div class="row col-12 mb-2 mt-2 mx-auto">
            <div class="row mt-2  ">
                <div class="col  text-center ">
                    <h4 class=" rounded-pill bg-success text-light p-2"> <?php echo $row_result_type_ID['INFO_Type_Product']; ?></h4>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------------->
        <!-- เอา ID_Type_Product ของประเภทสินค้ามาเทียบค่าว่าตรงกับค่า ข้อมูลในตาราง stock
        และแสดงข้อมูลที่มี ID_Type_Product ตรงกันเท่านั้น -->
        <?php
        $data_type_ID = [
            'id' => $row_result_type_ID['ID_Type_Product'],
        ];
        $sql_id = "SELECT * FROM stock WHERE TYPE_Product =:id  LIMIT 4 ";
        $smtm_fetch_id = $conn->prepare($sql_id);
        $smtm_fetch_id->execute($data_type_ID);
        $result_id =  $smtm_fetch_id->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!-- Loop ชั้นที่สองที่แสดงสินค้าที่ ID_Type_Product ตรงกับ TYPE_Product ของสินค้านั้นๆ-->
        <div class="row">
            <?php foreach ($result_id as $row_stock) { ?>
                <div class="col-md-2 col-4">
                    <form action="../sql/db_Add_cart.php" method="post">
                        <a <?php if ($row_stock['QTY_Product'] == 0) { ?> onclick=" out_stock() <?php   } ?>" class="box_product" href="" data-bs-toggle="modal" data-bs-target="<?php
                                                                                                                                                                                    if ($row_stock['QTY_Product'] > 0) { ?>
                    #product_popup<?php echo $row_stock['ID_Product'] ?>
                <?php } ?>">
                            <div class=" mt-1">
                                <div class="box_info_product ">
                                    <div class="box_product_img <?php
                                                                if ($row_stock['QTY_Product'] == 0) {
                                                                    echo "outstock";
                                                                }

                                                                ?> accordion-bodyoverflow-hidden"> <img class=" card-img-top mx-auto" src="../Asset/img/<?php echo $row_stock['IMG_Product']; ?>"></div>
                                    <div class="card-body">
                                        <p class="card-text text-wrap"><?php echo $row_stock['NAME_Product']; ?></p>
                                        <h5 class="card-text text-success"><?php echo $row_stock['PRICE_Product']; ?> บาท</h5>
                                    </div>
                                </div>
                            </div>
                            <?php if ($row_stock['QTY_Product'] == 0) { ?>
                                <div class="info_outstock ">
                                    <h5 class="mt-2">ขออภัยสินค้าหมด</h5>
                                </div>
                            <?php    } ?>

                        </a>
                        <!-- ป็อบอัพหยิบลงกะตร้า -->
                        <!-- Modal -->
                        <div class="modal fade" id="product_popup<?php echo $row_stock['ID_Product']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">สินค้าประเภท <?php echo $row_result_type_ID['INFO_Type_Product']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img class="card-img-top mx-auto" src="../Asset/img/<?php echo $row_stock['IMG_Product']; ?>">
                                        <div class="text-center">
                                            <p><?php echo $row_stock['NAME_Product']; ?></p>
                                            <p>สินค้าคงเหลือ <?php echo $row_stock['QTY_Product']; ?></p>
                                        </div>

                                        <div class="row text-center">
                                            <div class="col-md-6 mx-auto text-center ">
                                                <div class="input-group mb-3">
                                                    <a class="btn btn_number me-2" onclick="dec('QTY<?php echo $row_stock['ID_Product']; ?>')"><i class="fas fa-minus"></i></a>
                                                    <input class="form-control text-center" id="QTY<?php echo $row_stock['ID_Product']; ?>" name="QTY" type="number" value="1">
                                                    <a class="btn btn_number ms-2" onclick="inc('QTY<?php echo $row_stock['ID_Product']; ?>')"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success" type="submit" name="Add_Cart">หยิบลงตะกร้า</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ปุ่มหยิบสินค้าลงตะกร้า -->
                        <input type="hidden" name="ID_Product" value="<?php echo $row_stock['ID_Product']; ?>">
                    </form>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col">
                <div class="text-end type_full mt-2">
                    <a href="product_full.php?ID_Type_Product=<?php echo $row_result_type_ID['ID_Type_Product']; ?>   ">สินค้าเพิ่มเติม...</a>
                </div>
            </div>
        </div>

    </div>
<?php } ?>






<script>
    function inc(element) {
        let el = document.querySelector(`[id="${element}"]`);
        el.value = parseInt(el.value) + 1;
    }

    function dec(element) {
        let el = document.querySelector(`[id="${element}"]`);
        if (parseInt(el.value) > 0) {
            el.value = parseInt(el.value) - 1;
        }
    }
</script>


<script>
    function out_stock() {
        Swal.fire({
            icon: 'error',
            title: 'ขออภัยเนื้องจากสินค้าหมด',
            confirmButtonText: 'ยืนยัน',
            confirmButtonColor: '#d33',

        })
    }
</script>