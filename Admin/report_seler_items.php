<!-- ต่อฐานข้อมูล -->
<?php require_once('../sql/connect.php');
$data_date = [
    'date_start' => $_POST['date_start'],
    'date_end' => $_POST['date_end']
];
$sql_report_seler = "SELECT * ,SUM(s.PRICE_Product*od.QTY)as sumPrice 
,SUM(od.QTY)as sumQTY ,
SUM(od.QTY*s.Cost_PRICE_Product) as sumCost
FROM oder as o
JOIN oder_detail as od ON  o.ID_Oder = od.ID_Oder
JOIN stock as s ON s.ID_Product = od.ID_Product
JOIN type_product as tp ON tp.ID_Type_Product = s.TYPE_Product
WHERE date(o.Oder_date) BETWEEN :date_start AND :date_end AND  o.oder_status >=3 AND s.Status_Product = 1
GROUP BY date(o.Oder_date) ,s.ID_Product;

";
$stmt_report_seler = $conn->prepare($sql_report_seler);
$stmt_report_seler->execute($data_date);
$result_report_seler = $stmt_report_seler->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="box_report_page mx-auto my-3">
    <div class="row mt-2">
        <div class="col text-center">
            <h5>ร้านของมายด์</h5>
            <h5>รายงานยอดขาย สินค้า</h5>
            <p>ประจำวันที่ <?php echo date("d/m/Y", strtotime($data_date['date_start'])) ?> - <?php echo  date("d/m/Y", strtotime($data_date['date_end'])) ?></p>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">ลำดับ</th>
                <th scope="col">วันที่</th>
                <th scope="col">ชื่อสินค้า</th>
                <th scope="col">ราคา</th>
                <th scope="col">จำนวนการขาย</th>

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
                    <td class="text-end"><?php echo number_format($row_report['sumPrice'] - $row_report['sumCost'], 2); ?>บาท</td>
                    <td class="text-end"><?php echo number_format($row_report['sumQTY']); ?> ชิ้น</td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>