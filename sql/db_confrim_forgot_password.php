<?php
require_once('connect.php');

if (isset($_POST['confrim_reset_password'])) {
    $data_OTP = [
        'OTP' => $_POST['OTP']
    ];
    $sql = "SELECT * FROM member WHERE OTP=:OTP";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data_OTP);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() == 1) {
        foreach ($result as $row) {
            $data_password = [
                'ID_Member' => $row['ID_Member'],
                'password' => $_POST['password']

            ];
            $sql_password = "UPDATE member SET Pass=:password WHERE ID_Member=:ID_Member";
            $stmt_password = $conn->prepare($sql_password);
            $stmt_password->execute($data_password);

            // ปรับ OTP ให้เป็นค่าว่าง
            $data_otp_0 = [
                'ID_Member' => $row['ID_Member'],
                'OTP' => "",
            ];
            $sql_otp_0 = "UPDATE member SET OTP=:OTP WHERE ID_Member=:ID_Member";
            $stmt_otp_0 = $conn->prepare($sql_otp_0);
            $stmt_otp_0->execute($data_otp_0);
            Header("Location:../User/login.php");
        }
    }
    if ($stmt->rowCount() == 0) {
        $_SESSION['OTP_false'] = 1;
        Header("Location:../User/forgot_password_confrim.php");
    }
}
