<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php');


// รายงานยอดขาย
$data_date = [

    'date_start' => substr($_POST['date_select'], 0, 10),
    'date_end' => substr($_POST['date_select'], -10),

];
$sql_oder_date = "SELECT *,SUM(od.QTY) as sumQTY  FROM oder as o
JOIN oder_detail as od ON  o.ID_Oder = od.ID_Oder
JOIN stock as s ON s.ID_Product = od.ID_Product
JOIN type_product as tp ON tp.ID_Type_Product = s.TYPE_Product
WHERE date(o.Oder_date) BETWEEN :date_start AND :date_end AND s.Status_Product = 1
GROUP BY od.ID_Product
ORDER BY sumQTY DESC
";
$stmt_oder_date = $conn->prepare($sql_oder_date);
$stmt_oder_date->execute($data_date);
$result_oder_date = $stmt_oder_date->fetchAll(PDO::FETCH_ASSOC);


// ประเภทสินค้า
$sql_oder_date_type = "SELECT *,SUM(od.QTY) as sumQTY  FROM oder as o
JOIN oder_detail as od ON  o.ID_Oder = od.ID_Oder
JOIN stock as s ON s.ID_Product = od.ID_Product
JOIN type_product as tp ON tp.ID_Type_Product = s.TYPE_Product
WHERE date(o.Oder_date) BETWEEN :date_start AND :date_end AND s.Status_Product = 1
GROUP BY s.Type_Product
ORDER BY sumQTY DESC
";
$stmt_oder_date_type = $conn->prepare($sql_oder_date_type);
$stmt_oder_date_type->execute($data_date);
$result_oder_date_type = $stmt_oder_date_type->fetchAll(PDO::FETCH_ASSOC);



$sql_total_money_his = "SELECT *,
SUM((od.QTY*s.PRICE_Product)-(od.QTY*s.Cost_PRICE_Product)) as sumPrice
FROM oder as o
JOIN oder_detail as od ON  o.ID_Oder = od.ID_Oder
JOIN stock as s ON s.ID_Product = od.ID_Product
JOIN type_product as tp ON tp.ID_Type_Product = s.TYPE_Product
WHERE date(o.Oder_date) BETWEEN :date_start AND :date_end AND s.Status_Product = 1 AND o.oder_status >=3
GROUP BY o.oder_status;
";
$stmt_total_money_his = $conn->prepare($sql_total_money_his);
$stmt_total_money_his->execute($data_date);
$result_total_money_his = $stmt_total_money_his->fetchAll(PDO::FETCH_ASSOC);

// คำนวนยอดเงิน ป้ายขายหน้าร้าน
$sql_total_money_noti_shop = "SELECT *,SUM((od.QTY*s.PRICE_Product)-(od.QTY*s.Cost_PRICE_Product)) as sumPrice FROM oder as o
INNER JOIN oder_detail as od ON  o.ID_Oder = od.ID_Oder
INNER JOIN stock as s ON s.ID_Product = od.ID_Product
INNER JOIN type_product as tp ON tp.ID_Type_Product = s.TYPE_Product
WHERE date(o.Oder_date) BETWEEN :date_start AND :date_end AND s.Status_Product AND o.oder_status =4
GROUP BY s.ID_Product
";
$stmt_total_money_noti_shop = $conn->prepare($sql_total_money_noti_shop);
$stmt_total_money_noti_shop->execute($data_date);
$result_total_money_noti_shop = $stmt_total_money_noti_shop->fetchAll(PDO::FETCH_ASSOC);


// คำนวนยอดเงิน ป้ายขายหน้าร้าน
$sql_total_money_noti_online = "SELECT *,SUM((od.QTY*s.PRICE_Product)-(od.QTY*s.Cost_PRICE_Product)) as sumPrice FROM oder as o
INNER JOIN oder_detail as od ON  o.ID_Oder = od.ID_Oder
INNER JOIN stock as s ON s.ID_Product = od.ID_Product
INNER JOIN type_product as tp ON tp.ID_Type_Product = s.TYPE_Product
WHERE date(o.Oder_date) BETWEEN :date_start AND :date_end AND s.Status_Product AND o.oder_status =3
GROUP BY s.ID_Product
";
$stmt_total_money_noti_online = $conn->prepare($sql_total_money_noti_online);
$stmt_total_money_noti_online->execute($data_date);
$result_total_money_noti_online = $stmt_total_money_noti_online->fetchAll(PDO::FETCH_ASSOC);
?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<link rel="stylesheet" href="../Asset/css.css">


<?php
if ($result_oder_date) { ?>
    <div class="row mx-auto">

        <div class="col-xl-3 col-md-6 mb-4 mx-auto">
            <div class="card border-left-success border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2 text-center">
                            <div class="text-xs font-weight-bold text-success mb-1">
                                <h4>&#3647; ยอดขายหน้าร้าน</h4>
                            </div>

                            <div class="h4 mb-0 text-gray-800">
                                <?php $sum_noti_shop = 0; ?>
                                <?php foreach ($result_total_money_noti_shop as $row_noti_shop) { ?>
                                    <?php
                                    $result_noti_shop =  $row_noti_shop['sumPrice'];
                                    $sum_noti_shop = $sum_noti_shop +  $result_noti_shop
                                    ?>
                                <?php    } ?>
                                <p><?php echo number_format($sum_noti_shop, 2);  ?> บาท</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4 mx-auto">
            <div class="card border-left-success border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2 text-center">
                            <div class="text-xs font-weight-bold text-success mb-1">
                                <h4>&#3647; ยอดขายออนไลน์</h4>
                            </div>
                            <div class="h4 mb-0 text-gray-800">
                                <?php $sum_noti_online = 0; ?>
                                <?php foreach ($result_total_money_noti_online as $row_noti_online) { ?>
                                    <?php
                                    $result_noti_shop =  $row_noti_online['sumPrice'];
                                    $sum_noti_online = $sum_noti_online +  $result_noti_shop
                                    ?>
                                <?php    } ?>
                                <p><?php echo number_format($sum_noti_online, 2);  ?> บาท</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4 mx-auto">
            <div class="card border-left-success border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2 text-center">
                            <div class="text-xs font-weight-bold text-success mb-1">
                                <h4>&#3647; รายได้ของทั้งหมด</h4>
                            </div>
                            <div class="h4 mb-0 text-gray-800">
                                <p><?php echo number_format($sum_noti_online + $sum_noti_shop, 2);  ?> บาท</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="text-center ms-5">
        <div class="row mt-2">
            <div class="col-6 card pt-2">
                <p>ยอดขาย</p>
                <div id="chart_sales_his">
                </div>
            </div>
            <div class="col-6 card pt-2">
                <p>จำนวนการขายแต่ละประเภท</p>
                <div id="chart_sales_type">
                </div>
            </div>
        </div>
        <div class="row  mt-2">
            <div class="col-12 card pt-2">
                <p>จำนวนยอดขายของสินค้า</p>
                <div id="chart_sales">
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<script>
    let color = Math.floor(Math.random() * 16777215).toString(16);
    console.log("#" + color);
</script>

<!-- กราฟรายงานยอดขาย -->
<script>
    var options = {
        plotOptions: {
            bar: {
                distributed: true,
                borderRadius: 10,

            },
        },
        colors: [<?php
                    for ($x = 0; $x <= $stmt_oder_date_type->rowCount(); $x++) {
                        printf("'#%06X',\n", mt_rand(0, 0xFFFFFF));
                    }
                    ?>],
        series: [{
            name: 'จำนวนการขาย',
            data: [<?php
                    foreach ($result_oder_date_type as $row_oder_date) { ?>
                    <?php echo $row_oder_date['sumQTY']; ?>,
                <?php }
                ?>
            ]
        }],
        chart: {
            type: 'bar',
            height: 280,

        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
        },
        xaxis: {
            categories: [<?php
                            foreach ($result_oder_date_type as $row_oder_date) { ?> '<?php echo $row_oder_date['INFO_Type_Product']; ?>',
                <?php } ?>
            ],
        },
        yaxis: {
            title: {
                text: 'ชิ้น'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " ชิ้น"
                }
            }
        }
    };
    var chart_sales_type = new ApexCharts(document.querySelector("#chart_sales_type"), options);
    chart_sales_type.render();
</script>
<!-- กราฟรายงานยอดขาย -->
<script>
    var options = {
        plotOptions: {
            bar: {
                distributed: true,
                borderRadius: 10,
            },
        },
        colors: [<?php
                    for ($x = 0; $x <= $stmt_oder_date->rowCount(); $x++) {
                        printf("'#%06X',\n", mt_rand(0, 0xFFFFFF));
                    }
                    ?>],
        series: [{
            name: 'จำนวนการขาย',
            data: [<?php
                    foreach ($result_oder_date as $row_oder_date) { ?>
                    <?php echo $row_oder_date['sumQTY']; ?>,
                <?php }
                ?>
            ]
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: [<?php
                            foreach ($result_oder_date as $row_oder_date) { ?> '<?php echo $row_oder_date['NAME_Product']; ?>',
                <?php } ?>
            ],
        },
        yaxis: {
            title: {
                text: 'ชิ้น'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " ชิ้น"
                }
            }
        }
    };
    var chart_sales = new ApexCharts(document.querySelector("#chart_sales"), options);
    chart_sales.render();
</script>


<script>
    var options = {
        series: [<?php
                    foreach ($result_total_money_his as $row_total_money_his) { ?>
                <?php echo $row_total_money_his['sumPrice'] ?>,
            <?php }
            ?>
        ],
        colors: [<?php
                    for ($x = 0; $x <= $stmt_total_money_his->rowCount(); $x++) {
                        printf("'#%06X',\n", mt_rand(0, 0xFFFFFF));
                    }
                    ?>],
        chart: {
            width: 380,
            type: 'pie',
            toolbar: {
                show: true,
                offsetX: 100,
                offsetY: -30,
            }
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " บาท"
                }
            }
        },
        labels: ['ออนไลน์', 'หน้าร้าน'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart_sales_his"), options);
    chart.render();
</script>