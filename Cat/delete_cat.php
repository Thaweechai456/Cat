<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "its66040233102";
$password = "T7rgQ5W8";
$dbname =  "its66040233102";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามีการส่ง id มาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ใช้ prepared statement เพื่อหลีกเลี่ยง SQL injection
    $stmt = $conn->prepare("DELETE FROM CatBreeds WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" สำหรับ integer

    if ($stmt->execute()) {
        echo "<script>alert('ลบข้อมูลสำเร็จ'); window.location.href = 'index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
