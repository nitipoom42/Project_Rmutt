<?php require_once('connect.php');

if (isset($_POST['add'])) {
    $data = [
        'NAME_Product' => $_POST['NAME_Product']
    ];
    result($data);
}
