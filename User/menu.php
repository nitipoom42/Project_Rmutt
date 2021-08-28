<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php') ?>
<!-------------------------------------------------------------------->


<div class="Box_Menu row fixed-bottom  text-center overflow-hidden">
    <div class="Menu_item mt-3 col-4">
        <a class="text-info <?php if ($page == 'index') {
                                echo "text-dark";
                            } ?>  " href="index.php"><i class="fas fa-home"></i>
            <p>หน้าแรก</p>
        </a>
    </div>
    <div class="Menu_item  mt-3  col-4">
        <a class="text-info <?php if ($page == 'member') {
                                echo "text-dark";
                            } ?>" href="member.php "><i class="fas fa-coins"></i>
            <p>สมาชิก</p>
        </a>
    </div>

    <div class="Menu_item  mt-3  col-4">
        <a class="text-info <?php if ($page == 'history') {
                                echo "text-dark";
                            } ?>" href="history.php"><i class="fas fa-hand-holding-usd"></i>
            <p>แจ้งชำระเงิน</p>
        </a>
    </div>
</div>