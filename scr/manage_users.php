<?php
include('db.php');
session_start();

// Kiểm tra nếu người dùng đã đăng nhập và có quyền admin mới sử dụng đc
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

// Lấy danh sách người dùng
$sql = "SELECT id, username, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <link rel="stylesheet" href="./css/styles.css">
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}
.container {
    width: 80%;
    margin: auto;
    padding: 20px;
}
h1 {
    text-align: center;
    color: #333;
}
form {
    display: flex;
    justify-content: center;
    margin: 20px 0;
}
input[type="text"], select {
    padding: 10px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
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
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}
th {
    background-color: #007BFF;
    color: white;
}
.admin-header {
    display: flex;
    justify-content: space-between;
     align-items: center;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    font-size: 16px;
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
.content {
        padding: 20px;
        text-align: center;
        }

.home-image {
        max-width: 100%;
        height: auto;
        }
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

    <div class="content">
        <h1>Danh sách người dùng</h1>
        <table border="1">
    <tr>
        <th>Số thứ tự</th>
        <th>Tên đăng nhập</th>
        <th>Quyền</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['role']) ?></td>
        <td>
    <form action="edit_user.php" method="get" style="display: inline;">
        <button type="submit" name="id" value="<?= $row['id'] ?>">Sửa</button>
    </form>
    
    <form action="delete_user.php" method="get" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
        <button type="submit" name="id" value="<?= $row['id'] ?>">Xóa</button>
    </form>
</td>

    </tr>
    <?php endwhile; ?>
</table>

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
