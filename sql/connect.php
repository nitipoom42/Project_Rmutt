    <!-- ต่อฐานข้อมูล -->
    <?php
    session_start();

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
    <!-- ดูข้อมูลเป็น Array -->
    <?php
    function result($data)
    {
        echo ("<pre>");
        print_r($data);
        echo ("<pre>");
    }
    ?>