<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php');


// รายงานยอดขาย
$data_date = [

    'date_start' => substr($_POST['date_select'], 0, 10),
    'date_end' => substr($_POST['date_select'], -10),

];
$sql_oder_date = "SELECT *,SUM(od.QTY) as sumQTY  FROM oder_detail as od
JOIN oder as o ON  o.ID_Oder = od.ID_Oder
JOIN stock as s ON s.ID_Product = od.ID_Product
JOIN type_product as tp ON tp.ID_Type_Product = s.TYPE_Product
WHERE o.Oder_date BETWEEN :date_start AND :date_end
GROUP BY s.TYPE_Product";
$stmt_oder_date = $conn->prepare($sql_oder_date);
$stmt_oder_date->execute($data_date);
$result_oder_date = $stmt_oder_date->fetchAll(PDO::FETCH_ASSOC);
?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<?php
if ($result_oder_date) { ?>
    <div class="row">
        <div class="col-6 text-center">
            <p>ยอดขายทั้งหมด</p>
            <div id="chart_sales">
            </div>
        </div>
        <div class="col-6 text-center">
            <p>จำนวนการขายแต่ละประเภท</p>
            <div id="chart_sales_type">
            </div>
        </div>
    </div>
<?php } ?>




<!-- กราฟรายงานยอดขาย -->
<script>
    var options = {
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
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
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
                            foreach ($result_oder_date as $row_oder_date) { ?> '<?php echo $row_oder_date['INFO_Type_Product']; ?>',
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
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
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