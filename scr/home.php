<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, chuyển hướng tới trang đăng nhập
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Trường Đại học Trà Vinh</title>
    <link rel="stylesheet" href="./css/home.css">
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
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

.main-container {
    display: flex;
    flex-wrap: wrap;
    padding: 20px;
}

.left-panel, .right-panel {
    background-color: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 15px;
    margin: 10px;
}

.left-panel {
    flex: 3;
}

.right-panel {
    flex: 1;
}

.announcement {
    display: flex;
    align-items: center;
    gap: 15px;
}

.announcement img {
    height: 100px;
}

.announcement-list ul {
    list-style-type: none;
    padding: 0;
}

.announcement-list li {
    margin: 10px 0;
}

.announcement-list a {
    text-decoration: none;
    color: #0066cc;
}

.announcement-list a:hover {
    text-decoration: underline;
}

.container {
    display: flex;             /* Sử dụng Flexbox */
    flex-direction: column;    /* Chuyển các phần tử thành cột */
    justify-content: center;   /* Căn giữa theo chiều dọc */
    align-items: center;       /* Căn giữa theo chiều ngang */
    gap: 10px;                 /* Khoảng cách giữa tiêu đề và form */
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: fit-content;        /* Chiều rộng theo nội dung */
    margin: auto;              /* Căn giữa toàn bộ container */
    margin-top: 30px;
}

.container form {
    display: flex;
    gap: 10px;
}


.container input,
.container select,
.container button {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.container button {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.container button:hover {
    background-color: #0056b3;
}


.features ul li a {
    text-decoration: none; 
    color: #007BFF; 
    font-weight: bold; 
}

.features ul li a:hover {
    color: #0056b3; 
    text-decoration: underline; 
}
.footer {
    background-color: #0066cc;
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 14px;
    margin-top: 300px;
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
    <div class="container">
        <h1>Tra cứu học phần</h1>
        <form method="GET" action="search.php">
            <input type="text" name="query" placeholder="Nhập tên học phần">
            <select name="semester">
                <option value="">Tất cả học kỳ</option>
                <option value="1">Học kỳ 1</option>
                <option value="2">Học kỳ 2</option>
            </select>
            <button type="submit">Tìm học phần</button>
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


