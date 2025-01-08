<?php

session_start();

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header("Location: index.php");
    exit;
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "StudyFinder");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy thông tin từ GET
$query = isset($_GET['query']) ? $_GET['query'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';
$user_id = $_SESSION['user_id']; // Lấy user_id từ session

// Kiểm tra vai trò
$is_admin = ($_SESSION['role'] === 'admin');

// Tạo câu truy vấn và tham số
if ($is_admin) {
    $sql = "SELECT * FROM sections WHERE section_name LIKE ?";
    $type_param = "s";
    $params = ["%$query%"];
} else {
    $sql = "SELECT * FROM sections WHERE user_id = ? AND section_name LIKE ?";
    $type_param = "is";
    $params = [$user_id, "%$query%"];
}

if (!empty($semester)) {
    $sql .= " AND semester = ?";
    $type_param .= "s";
    $params[] = $semester;
}

// Chuẩn bị câu truy vấn
$stmt = $conn->prepare($sql);

// Bind tham số
$stmt->bind_param($type_param, ...$params);

// Thực thi câu truy vấn
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tra cứu học phần</title>
    <link rel="stylesheet" href="./css/search.css">
    <style>
       
    </style>
</head>
<body>
    <div class="container">
        <h1>Tra cứu học phần</h1>
        <table>
            <tr>
            <th>Tên học phần</th>
            <th>Mã học phần</th>
            <th>Khóa</th>
            <th>Học Kỳ</th>
            <th>Tín chỉ lý thuyết</th>
            <th>Tín chỉ thực hành</th>
            <th>Loại môn học</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                    <td><?= htmlspecialchars($row['section_name']) ?></td>
                    <td><?= htmlspecialchars($row['course_code']) ?></td>
                    <td><?= htmlspecialchars($row['course_name']) ?></td>
                    <td><?= htmlspecialchars($row['semester']) ?></td>
                    <td><?= htmlspecialchars($row['theoretical_credits']) ?></td>
                    <td><?= htmlspecialchars($row['practical_credits']) ?></td>
                    <td><?= htmlspecialchars($row['course_type']) ?></td>
                    
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                    <td>
                        <a href="edit_section.php?id=<?= $row['id'] ?>" class="back-btn">Sửa</a>
                        <a href="delete_section.php?id=<?= $row['id'] ?>" class="back-btn">xóa</a>
                    </td>
                    <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Không tìm thấy học phần</td>
                </tr>
            <?php endif; ?>
        </table>
        
        <a href="index.php" class="back-btn">Quay lại trang chủ</a>
    </div>
</body>
</html>

<?php
// Đóng kết nối
$stmt->close();
$conn->close();
?>
