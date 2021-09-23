<?php
require_once('connect.php');


if (isset($_POST['reset_password'])) {
    $data_OTP = [
        'email' => $_POST['email'],
        'OTP' => rand()
    ];

    $sql = "UPDATE member SET OTP=:OTP WHERE email=:email";
    $smtm = $conn->prepare($sql);
    $smtm->execute($data_OTP);

    $data_member = [
        'email' => $_POST['email']
    ];

    $sql_member = "SELECT * FROM member WHERE email=:email";
    $smtm_member = $conn->prepare($sql_member);
    $smtm_member->execute($data_member);
    $result_member = $smtm_member->fetchAll(PDO::FETCH_ASSOC);



    foreach ($result_member as $row_member) {
        $mailto = $row_member["email"];
        $subject = "เปลี่ยนรหัสผ่าน";
        $name = "Web_Time_Skip";
        $mail_user = 'ineedgam@i-need-game.com';
        $message = $row_member["OTP"];
        $header_mail = "Content-type: text/html; charset=utf-8\n";
        $header_mail .= "From: " . $name . " E-mail : " . $mail_user;
        mail($mailto, $subject, $message, $header_mail);
    }

    $_SESSION['OTP'] = 1;
    Header("Location:../User/forgot_password_confrim.php");
}
