<?php require_once('connect.php') ?>
<?php
$data = [
    'ID' => $_POST['ID']
];
$sql = "SELECT * FROM bank WHERE ID_bank=:ID";
$stmt = $conn->prepare($sql);
$stmt->execute($data);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    foreach ($result as $row) { ?>
        <div class="mx-auto">
            <div class="img_bank"><img src="../Asset/img_bank/<?php echo $row['IMG_bank'] ?>" alt=""></div>
        </div>
    <?php  } ?>
</body>

</html>