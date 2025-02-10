<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "its66040233102";  // กำหนดค่าของ $username ให้ถูกต้อง
$password = "T7rgQ5W8";
$dbname =  "its66040233102";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รายการรูปภาพแมว
$imageList = [
    "Bengal1.jpg", "Bengal2.jpg", "British Shorthair1.jpg", "British Shorthair2.jpg",
    "Exotic1.jpg", "Exotic2.jpg", "Exotic3.jpg", "Main Coon1.jpg", "Main Coon2.jpg",
    "Main Coon3.jpg", "Top 10 Cats_2.jpg", "americanShorthair1.jpg", "americanShorthair2.jpg",
    "americanShorthair3.jpg", "khaomanee1.jpg", "khaomanee2.jpg", "khaomanee3.jpg",
    "korat1.jpg", "korat2.jpg", "korat3.jpg", "persia1.jpg", "persia2.jpg", "persia3.jpg",
    "scotichfold1.jpg", "scotichfold2.jpg", "scotichfold3.jpg", "shorthair1.jpg", "siamese1.jpg",
    "siamese2.jpg", "siamese3.jpg"
];

function generateImageGrid($imageList, $username) {
    $count = 0;
    $output = "<div class='row'>";
    
    foreach ($imageList as $image) {
        $imageName = pathinfo($image, PATHINFO_FILENAME);
        $url = "https://hosting.udru.ac.th/{$username}/Cat/Cat/{$image}";

        if ($count % 4 == 0 && $count != 0) {
            $output .= "</div><div class='row'>";
        }

        $output .= "<div class='col-md-3'>
                        <div class='img-card'>
                            <a href='{$url}' target='_blank'>
                                <img src='{$url}' alt='{$imageName}'>
                                <span>{$imageName}</span>
                            </a>
                        </div>
                    </div>";
        $count++;
    }
    $output .= "</div>";
    return $output;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกดูรูปภาพแมว</title>
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
        .container {
            margin-top: 50px;
        }
        .img-card {
            text-align: center;
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            background-color: #FFFFFF; /* สีพื้นหลังของการ์ด */
        }
        .img-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .img-card a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        .row {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="admin.php">Home Admin</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2>เลือกดูรูปภาพแมว</h2>
    <?php echo generateImageGrid($imageList, $username); ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
