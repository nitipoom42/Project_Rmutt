  <?php
  session_start();
  date_default_timezone_set("Asia/Bangkok");
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "nongmindshop";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo "เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage();
  }
  ?>

  <?php
  function result($data)
  {
    echo ("<pre>");
    print_r($data);
    echo ("<pre>");
  }
  ?>