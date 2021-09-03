<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>
<!-------------------------------------------------------------------->


<div class="Box_Menu row fixed-bottom  text-center overflow-hidden shadow">
    <div class="Menu_item mt-3 col-4">
        <div class="mx-auto box_info_menu <?php if ($page == 'index') {
                                                echo "bg_info_menu";
                                            } ?>  "">
            <a class=" info_menu <?php if ($page == 'index') {
                                        echo "text-light ";
                                    } ?> " href=" index.php"><i class="fas fa-home"></i>
            <p>หน้าแรก</p>
            </a>
        </div>

    </div>
    <div class="Menu_item  mt-3  col-4">
        <div class="mx-auto box_info_menu <?php if ($page == 'member') {
                                                echo "bg_info_menu";
                                            } ?>"">
            <a class=" info_menu <?php if ($page == 'member') {
                                        echo "text-light";
                                    } ?>" href="member.php "><i class="fas fa-coins"></i>
            <p>สมาชิก</p>
            </a>
        </div>

    </div>

    <div class="Menu_item  mt-3  col-4">
        <div class="mx-auto box_info_menu <?php if ($page == 'history') {
                                                echo "bg_info_menu";
                                            } ?>"">
            <a class=" info_menu <?php if ($page == 'history') {
                                        echo "text-light";
                                    } ?>" href="history.php"><i class="fas fa-hand-holding-usd"></i>
            <p>แจ้งชำระเงิน</p>
            </a>
        </div>

    </div>
</div>