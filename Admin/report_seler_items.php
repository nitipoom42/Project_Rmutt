<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php');
$data_date = [
    'date_start' => $_POST['date_start'],
    'date_end' => $_POST['date_end']
];
$sql_report_seler = "SELECT *,SUM(od.QTY) as sumQTY, SUM(od.QTY*s.PRICE_Product) as sumPrice FROM oder_detail as od
JOIN oder as o ON  o.ID_Oder = od.ID_Oder
JOIN stock as s ON s.ID_Product = od.ID_Product
JOIN type_product as tp ON tp.ID_Type_Product = s.TYPE_Product
WHERE date(o.Oder_date) BETWEEN :date_start AND :date_end
GROUP BY od.ID_Product
ORDER BY sumQTY DESC
";
$stmt_report_seler = $conn->prepare($sql_report_seler);
$stmt_report_seler->execute($data_date);
$result_report_seler = $stmt_report_seler->fetchAll(PDO::FETCH_ASSOC);
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
                <th scope="col">ราคา</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result_report_seler as $key => $row_report) { ?>

                <tr>
                    <td class="text-center"><?php echo $key + 1 ?></th>
                    <td><?php
                        echo  date("d/m/Y", strtotime(substr($row_report['Oder_date'], 0, 10)));
                        ?></td>
                    <td><?php echo $row_report['NAME_Product']; ?></td>
                    <td class="text-center"><?php echo number_format($row_report['sumQTY']); ?></td>
                    <td class="text-center"><?php echo number_format($row_report['sumPrice'], 2); ?>.-บาท</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>