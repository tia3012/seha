<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sehe";
$port = "3307"; 

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}
if (isset($_POST['identity_number']) && isset($_POST['service_code'])) {
    $identity_number = $_POST['identity_number'];
    $service_code = $_POST['service_code'];

    // استعلام البيانات
    $sql = "SELECT employees.name, medical_leaves.reason, medical_leaves.start_date, 
            medical_leaves.end_date, medical_leaves.status
            FROM medical_leaves 
            JOIN employees ON medical_leaves.employee_id = employees.employee_id 
            WHERE employees.contact_info = '$identity_number' 
            AND medical_leaves.leave_id = '$service_code'";
    $result = $conn->query($sql);

    echo "<!DOCTYPE html>";
    echo "<html lang='ar' dir='rtl'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>نتيجة الاستعلام</title>";
    echo "<link href='https://fonts.googleapis.com/css2?family=Tajawal:wght@400;600&display=swap' rel='stylesheet'>";
    echo "<style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #3E4E56;
            font-weight: 600;
        }
        .details {
            margin-top: 30px;
            text-align: right;
        }
        .details p {
            font-size: 18px;
            margin: 10px 0;
        }
        .details span {
            font-weight: bold;
            color: #1a73e8;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .back-button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #5a6268;
        }
    </style>";
    echo "</head>";
    echo "<body>";
    echo "<div class='container'>";

    if ($result->num_rows > 0) {
        echo "<h1>تفاصيل طلب الإجازة</h1>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='details'>";
            echo "<p>اسم الموظف: <span>" . $row['name'] . "</span></p>";
            echo "<p>سبب الإجازة: <span>" . $row['reason'] . "</span></p>";
            echo "<p>تاريخ البدء: <span>" . $row['start_date'] . "</span></p>";
            echo "<p>تاريخ الانتهاء: <span>" . $row['end_date'] . "</span></p>";
            echo "<p>حالة الإجازة: <span>" . $row['status'] . "</span></p>";
            echo "</div>";
        }
    } else {
        echo "<h2>لا توجد نتائج مطابقة.</h2>";
    }

    echo "<div class='button-container'>";
    echo "<button class='button' onclick='window.location.href=\"index.php\"'>رجوع للاستمارات</button>";
    echo "</div>";

    echo "</div>";
    echo "</body>";
    echo "</html>";
} else {
    echo "الرجاء إدخال جميع الحقول المطلوبة.";
}

// إغلاق الاتصال
$conn->close();
?>