<?php
session_start();
require_once 'db.php';

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Lấy `id` từ URL
if (!isset($_GET['id'])) {
    die("ID học phần không tồn tại.");
}
$id = intval($_GET['id']);

// Truy vấn cơ sở dữ liệu để lấy thông tin học phần
$sql = "SELECT * FROM sections WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Không tìm thấy học phần với ID này.");
}

$section = $result->fetch_assoc();

// Xử lý khi nhấn nút Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $section_name = $_POST['section_name']; 
    $semester = $_POST['semester'];
    $theoretical_credits = $_POST['theoretical_credits'];
    $practical_credits = $_POST['practical_credits'];
    $course_type = $_POST['course_type']; 

    // Truy vấn cập nhật thông tin học phần
    $sql = "UPDATE sections 
            SET course_code = ?, course_name = ?, section_name = ?, semester = ?, 
                theoretical_credits = ?, practical_credits = ?, course_type = ? 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssi", 
        $course_code, 
        $course_name, 
        $section_name, 
        $semester,  
        $theoretical_credits, 
        $practical_credits, 
        $course_type, 
        $id
    );

    if ($stmt->execute()) {
        echo "Cập nhật thành công!";
        header("Location: search.php");
        exit;
    } else {
        echo "Có lỗi xảy ra: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa học phần</title>
    <link rel="stylesheet" href="css/edit_section.css">
</head>
<body>
    <h1>Chỉnh sửa học phần</h1>
    <form method="POST">
        <label for="section_name">Tên học phần:</label><br>
        <input type="text" id="section_name" name="section_name" value="<?= htmlspecialchars($section['section_name']) ?>"><br><br>

        <label for="course_code">Mã học phần:</label><br>
        <input type="text" id="course_code" name="course_code" value="<?= htmlspecialchars($section['course_code']) ?>"><br><br>

        <label for="course_name">Khóa:</label><br>
        <input type="text" id="course_name" name="course_name" value="<?= htmlspecialchars($section['course_name']) ?>"><br><br>

        <label for="semester">Học kỳ:</label><br>
        <input type="text" id="semester" name="semester" value="<?= htmlspecialchars($section['semester']) ?>"><br><br>

        <label for="theoretical_credits">Số tín chỉ lý thuyết:</label><br>
        <input type="number" id="theoretical_credits" name="theoretical_credits" value="<?= htmlspecialchars($section['theoretical_credits']) ?>"><br><br>

        <label for="practical_credits">Số tín chỉ thực hành:</label><br>
        <input type="number" id="practical_credits" name="practical_credits" value="<?= htmlspecialchars($section['practical_credits']) ?>"><br><br>

        <label for="course_type">Loại môn học:</label><br>
        <select id="course_type" name="course_type">
            <option value="Bắt buộc" <?= $section['course_type'] === 'Bắt buộc' ? 'selected' : '' ?>>Bắt buộc</option>
            <option value="Tự chọn" <?= $section['course_type'] === 'Tự chọn' ? 'selected' : '' ?>>Tự chọn</option>
        </select><br><br>
        
        <button type="submit">Cập nhật</button>
        
        <a href="index.php" class="back-btn">Quay lại trang chủ</a>
    </form>
</body>
</html>
