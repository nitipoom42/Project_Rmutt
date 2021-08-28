<!-- ต่อฐานข้อมูล -->
<?php require_once('connect.php') ?>

<?php

if (isset($_POST['Login'])) {
    $data_login = [
        'User' => $_POST['User'],
        'Pass' => $_POST['Pass'],
    ];
    try {
        $sql_login = "SELECT * FROM member WHERE User=:User AND Pass=:Pass";
        $stmt_login = $conn->prepare($sql_login);
        $stmt_login->execute($data_login);
        $result_login = $stmt_login->fetch(PDO::FETCH_ASSOC);

        if ($stmt_login->rowCount() == 1) {
            $_SESSION['User'] = $result_login['User'];
            $_SESSION['Pass'] = $result_login['Pass'];
            $_SESSION['ID_Member'] = $result_login['ID_Member'];
            $_SESSION['status'] = 1;
            Header("Location:../User/index.php");
        } else {
            $_SESSION['login_fall'] = 1;
            Header("Location:../User/login.php");
        }
    } catch (PDOException $e) {
        echo "เรียกข้อมูลไม่สำเสร็จ: " . $e->getMessage();
    }
}
?>