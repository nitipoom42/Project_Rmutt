<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php');
$data_date = [
    'date_start' => $_POST['date_start'],
    'date_end' => $_POST['date_end']
];
// ประเภทสินค้า
$sql_seler_type = "SELECT *,SUM(od.QTY) as sumQTY  FROM oder_detail as od
JOIN oder as o ON  o.ID_Oder = od.ID_Oder
JOIN stock as s ON s.ID_Product = od.ID_Product
JOIN type_product as tp ON tp.ID_Type_Product = s.TYPE_Product
WHERE date(o.Oder_date) BETWEEN :date_start AND :date_end
GROUP BY date(o.Oder_date)";
$stmt_seler_type = $conn->prepare($sql_seler_type);
$stmt_seler_type->execute($data_date);
$result_seler_type = $stmt_seler_type->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="box_report_page mx-auto my-3">
    <div class="row mt-2">
        <div class="col text-center">
            <h5>ร้านของมายด์</h5>
            <h5>รายงานยอดขาย</h5>
            <p>ประจำวันที่ <?php echo date("d/m/Y", strtotime($data_date['date_start'])) ?> - <?php echo  date("d/m/Y", strtotime($data_date['date_end'])) ?></p>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">ลำดับ</th>
                <th scope="col">วันที่</th>
                <th scope="col">ชื่อสินค้า</th>
                <th scope="col">จำนวนการขาย</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result_seler_type as $key => $row_report) { ?>
                <tr>
                    <td class="text-center"><?php echo $key + 1 ?></th>
                    <td><?php
                        echo  date("d/m/Y", strtotime(substr($row_report['Oder_date'], 0, 10)));
                        ?></td>
                    <td class="text-center"><?php echo $row_report['INFO_Type_Product']; ?></td>
                    <td class="text-center"><?php echo number_format($row_report['sumQTY']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>