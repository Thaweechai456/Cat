<?php
// เชื่อมต่อฐานข้อมูล (Connect to the database)
$servername = "localhost";
$username = "its66040233102";
$password = "T7rgQ5W8";
$dbname =  "its66040233102";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่าคำค้นหาจากฟอร์ม (Get search value from form)
$search = isset($_POST['search']) ? $_POST['search'] : '';

// สร้าง SQL query สำหรับค้นหาข้อมูล (Create SQL query to search data)
$sql = "SELECT * FROM CatBreeds WHERE (name_th LIKE '%$search%' OR name_en LIKE '%$search%') AND is_visible = 1";
$result = $conn->query($sql);

$conn->close();
?>

<?php
session_start();

// ตรวจสอบว่ามีการเข้าสู่ระบบหรือยัง
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แสดงข้อมูลสายพันธุ์แมว (Display Cat Breeds Information)</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E0F7FA; /* ฟ้าอ่อน */
        }
        .navbar {
            margin-bottom: 30px;
            background-color: #FFCDD2; /* สีแดงอ่อน */
            border-color: #FFABAB; /* สีแดงออกชมพู */
        }
        .navbar a {
            color: #B71C1C; /* สีตัวอักษรเป็นสีแดงเข้ม */
        }
        .navbar a:hover {
            color: #D32F2F; /* สีตัวอักษรเมื่อ hover */
        }
        .cat-card {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .cat-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-edit, .btn-delete {
            margin: 5px;
        }
        .search-box {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="admin.php">Home Admin</a></li>
                <li><a href="add_cat.php">Add Cat</a></li>
                <li><a href="visible.php">Edit</a></li>
                <li><a href="imageList.php" target="_blank">IMG</a></li>
                <li>  <a href="logout.php " >ออกจากระบบ</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2>สายพันธุ์แมวยอดนิยม (Popular Cat Breeds)</h2>
    
    <!-- ฟอร์มค้นหาข้อมูล (Search form) -->
    <form method="POST" action="">
        <div class="search-box">
            <input type="text" class="form-control" name="search" placeholder="ค้นหาสายพันธุ์แมว... (Search for cat breeds...)" value="<?php echo htmlspecialchars($search); ?>">
        </div>
    </form>

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4'>";
                echo "<div class='cat-card'>";
                echo "<h3>" . $row['name_th'] . " (" . $row['name_en'] . ")</h3>";
                echo "<img src='" . $row['image_url'] . "' alt='Image'>";
                echo "<p><strong>คำอธิบาย:</strong> " . $row['description'] . "</p>";
                echo "<p><strong>ลักษณะทั่วไป:</strong> " . $row['characteristics'] . "</p>";
                echo "<p><strong>คำแนะนำการเลี้ยงดู:</strong> " . $row['care_instructions'] . "</p>";
                echo "<a href='edit_cat.php?id=" . $row['id'] . "'>แก้ไข (Edit)</a> | ";
                echo "<a href='delete_cat.php?id=" . $row['id'] . "'>ลบ (Delete)</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>ไม่มีข้อมูลแสดง (No data to display)</p>";
        }
        ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>
