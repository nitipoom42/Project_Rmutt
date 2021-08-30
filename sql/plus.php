
<?php

require_once('connect.php');

$data_QTY = [
    'id' => $_POST['id'],
    'QTY' => 1,

];
$sql_QTY = "UPDATE stock SET QTY_Product=QTY_Product-:QTY WHERE ID_Product=:id ";
$stmt_QTY = $conn->prepare($sql_QTY);
$stmt_QTY->execute($data_QTY);

$sql_QTY_promotion = "UPDATE stock_promotion SET QTY_Product=QTY_Product-:QTY WHERE ID_Product_Promotion=:id ";
$stmt_QTY_promotion = $conn->prepare($sql_QTY_promotion);
$stmt_QTY_promotion->execute($data_QTY);

$data_plus = [
    'id' => $_POST['id'],
    'QTY' => 1,
];

$sql_plus = "UPDATE cart SET QTY=QTY+:QTY WHERE ID_Product=:id LIMIT 1 ";
$stmt_plus = $conn->prepare($sql_plus);
$stmt_plus->execute($data_plus);


?>