
    <?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nongmindshop";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $res_data = json_decode(file_get_contents("php://input"));

        if ($res_data->action == "fetchall") {

            $data_member = [
                'ID_Member' => $_SESSION['ID_Member'],
            ];

            $sql = "SELECT * ,SUM(c.QTY) as QTY FROM cart  as c
            JOIN stock as s ON c.ID_Product=s.ID_Product
            JOIN type_product as t ON s.TYPE_Product = t.ID_Type_Product
            WHERE c.ID_Member = :ID_Member
            GROUP BY s.ID_Product;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($row);
        }
        if ($res_data->action == 'insert') {

            $data = [
                ':NAME_Product' => $res_data->NAME_Product
            ];

            $sql = "INSERT INTO stock (NAME_Product) VALUES (:NAME_Product)";
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
        }
    } catch (PDOException $e) {
        echo "เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage();
    }

    ?>