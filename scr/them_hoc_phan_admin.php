<?php
session_start(); // Bắt đầu session

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header("Location: login.php");
    exit;
}

// Kiểm tra quyền truy cập (chỉ admin được phép truy cập)
if ($_SESSION['role'] !== 'admin') {
    echo "Bạn không có quyền truy cập trang này!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản trị</title>
    <link rel="stylesheet" href="./css/them_hoc_phan_admin.css">
    <style>
.footer {
    background-color: #0066cc;
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 14px;
    margin-top: 210px;
}

.footer a {
    color: #ffcc00;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>
<header class="header">
        <div>
            <img src="./image/logo.jpg" alt="Logo Đại học Trà Vinh">
        </div>
        <nav>
            <a href="index.php">Trang chủ</a>
            <a href="add_user.php">Thêm người dùng</a>
            <a href="manage_users.php">Quản lý người dùng</a>
            <a href="them_hoc_phan_admin.php">Thêm Học phần</a>
            <a href="logout.php">Đăng xuất</a>
        </nav>
    </header>
    <div class="container">
        <h2>Thêm học phần</h2>
        
        <form method="POST" action="add_section.php" class="add-form">
            <input type="text" name="section_name" placeholder="Tên học phần" required>
            <input type="text" name="course_code" placeholder="Mã học phần" required>
            <input type="text" name="course_name" placeholder="Tên khóa học" required>
            <input type="number" name="semester" placeholder="Học kỳ" required>
            <input type="number" name="theoretical_credits" placeholder="Tín chỉ lý thuyết" required>
            <input type="number" name="practical_credits" placeholder="Tín chỉ thực hành" required>
            <select name="course_type" required>
                <option value="Bắt buộc">Bắt buộc</option>
                <option value="Tự chọn">Tự chọn</option>
            </select>
            <input type="number" name="user_id" placeholder="ID Sinh viên" required>
            <button type="submit">Thêm học phần</button>
        </form>
    </div>
    <footer class="footer">
    <div class="footer-content">
        <p><strong>CỔNG THÔNG TIN SINH VIÊN</strong></p>
        <p>Đ/c: Tp. Trà Vinh, tỉnh Trà Vinh.</p>
        <p>Điện thoại: (0294) 0919899616</p>
        <p>Email: <a href="dotv2302@gmail.com">dotv2302@gmail.com</a> (mọi thắc mắc, vui lòng liên hệ qua email này).</p>
    </div>
    </footer>
</body>
</html>
