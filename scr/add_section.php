<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "StudyFinder");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
$section_name = $_POST['section_name']; //Tên học phần
$course_code = $_POST['course_code']; //Mã học phần
$course_name = $_POST['course_name']; // Tên khóa
$semester = $_POST['semester']; //Học kỳ
$user_id = $_POST['user_id']; //User id
$theoretical_credits = $_POST['theoretical_credits']; // Tín chỉ lý thuyết
$practical_credits = $_POST['practical_credits'];     // Tín chỉ thực hành
$course_type = $_POST['course_type'];  // Loại môn học (bắt buộc, tự chọn)

// Kiểm tra và thêm dữ liệu vào bảng
$sql = "INSERT INTO sections (section_name, course_code, course_name, semester, user_id, theoretical_credits, practical_credits, course_type) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Gán tham số cho câu truy vấn
$stmt->bind_param("ssssiids", $section_name, $course_code, $course_name, $semester, $user_id, $theoretical_credits, $practical_credits, $course_type);


// Thực thi câu truy vấn
if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Error: " . $stmt->error;
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
