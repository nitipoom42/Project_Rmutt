<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php');
$data_date = [

    'date_start' => substr($_POST['date_select'], 0, 10),
    'date_end' => substr($_POST['date_select'], -10),

];
$sql_oder_date = "SELECT *,SUM(od.QTY) as sumQTY  FROM oder_detail as od
JOIN oder as o ON  o.ID_Oder = od.ID_Oder
JOIN stock as s ON s.ID_Product = od.ID_Product
WHERE Oder_date BETWEEN :date_start AND :date_end
GROUP BY od.ID_Product";
$stmt_oder_date = $conn->prepare($sql_oder_date);
$stmt_oder_date->execute($data_date);
$result_oder_date = $stmt_oder_date->fetchAll(PDO::FETCH_ASSOC);


?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
    #chart {
        width: 50rem;
        height: 10rem;
    }
</style>

<div id="chart">
</div>

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

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>