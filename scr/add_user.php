<?php
// Kết nối cơ sở dữ liệu
include('db.php');

session_start();

// Kiểm tra nếu người dùng đã đăng nhập và có quyền admin mới sử dụng đc
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

// Kiểm tra nếu form được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id']; // Lấy user_id từ form
    $name = $_POST['name']; // Lấy tên từ form
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mã hóa mật khẩu
    $role = $_POST['role']; // Lấy quyền từ form

    // kiểm tra nếu role ko hợp lệ ko đc vào
    $valid_roles = ['user', 'admin'];
    if (!in_array($role, $valid_roles)) {
        die("Quyền không hợp lệ.");
    }

    // Thêm người dùng 
    $sql = "INSERT INTO users (user_id, name, username, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $user_id, $name, $username, $password, $role);

    if ($stmt->execute()) {
        echo "Thêm người dùng thành công!";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Người Dùng</title>
    <link rel="stylesheet" href="./css/add_user.css">
    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    text-align: center; /* Đặt nội dung ở giữa theo chiều ngang */
}

form {
    display: inline-block; /* Giữ form ở giữa trang */
    margin-top: 20px;
    background-color: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    
}

input[type="text"], 
input[type="password"], 
select {
    width: 300px; /* Đặt chiều rộng cố định */
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; /* Đảm bảo padding không làm thay đổi kích thước */
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

button {
    padding: 10px 20px;
    border: none;
    background-color: #007BFF;
    color: white;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}
.header {
    background-color: #0066cc;
    color: white;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.header img {
    width: 100px; /* Đặt kích thước chiều rộng */
    height: 100px; /* Đặt kích thước chiều cao */
    border-radius: 50%; /* Làm cho ảnh thành hình tròn */
    object-fit: cover; /* Đảm bảo ảnh không bị méo và lấp đầy khu vực hình tròn */
}

.header nav {
    display: flex;
    gap: 15px;
}

.header nav a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}
.footer {
    background-color: #0066cc;
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 14px;
    margin-top: 20px;
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
            <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="add_user.php">Thêm người dùng</a>
            <a href="manage_users.php">Quản lý người dùng</a>
            <a href="them_hoc_phan_admin.php">Thêm Học phần</a>
            <?php endif; ?>
            <a href="logout.php">Đăng xuất</a>
        </nav>
    </header>
   
    <form action="add_user.php" method="POST">
        <h1>Thêm Người Dùng</h1>
        <label for="user_id">ID Người Dùng:</label>
        <input type="text" id="user_id" name="user_id" required><br><br>

        <label for="name">Họ và tên:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="role">Quyền:</label><br>
        <select id="role" name="role" required>
            <option value="user">Người dùng</option>
            <option value="admin">Quản trị viên</option>
        </select><br><br>

        <button type="submit">Thêm người dùng</button>
    </form>
    <br>
    
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
