<?php
session_start();
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "studyfinder");
// Kiểm tra nếu người dùng đã đăng nhập và có quyền admin mới sử dụng đc
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu có ID người dùng được truyền qua URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Lấy thông tin người dùng từ cơ sở dữ liệu
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("Không tìm thấy người dùng.");
    }
} else {
    die("ID người dùng không hợp lệ.");
}

// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Nếu mật khẩu trống, giữ nguyên mật khẩu cũ
    if (empty($password)) {
        $password = $user['password']; // Giữ mật khẩu cũ nếu không thay đổi
    } else {
        // Nếu mật khẩu không trống, mã hóa mật khẩu mới
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    // Cập nhật thông tin người dùng vào cơ sở dữ liệu
    $update_sql = "UPDATE users SET username = ?, password = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $username, $password, $user_id); // Sửa kiểu tham số ở đây

    if ($update_stmt->execute()) {
        echo "Cập nhật thông tin người dùng thành công!";
    } else {
        echo "Lỗi: " . $update_stmt->error;
    }

    $update_stmt->close();
    $conn->close();

    // Chuyển hướng về trang khác (hoặc quay lại trang người dùng)
    header("Location: manage_users.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa người dùng</title>
    <link rel="stylesheet" href="./css/edit_user.css">
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
    </style>
</head>
<body>
    

    <!-- Form chỉnh sửa thông tin người dùng -->
    <form action="edit_user.php?id=<?php echo $user_id; ?>" method="POST">
        <h1>Chỉnh sửa người dùng</h1>
        <label for="username">Tên người dùng:</label>
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
        <br>
        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" id="password" placeholder="Nhập mật khẩu mới (nếu thay đổi)"><br>
        <br>
        <button type="submit">Cập nhật</button>
        <a href="admin.php">
        <button type="button" class="button">Quay lại </button>
    </a>
    </form>
        <br>
    
</body>
</html>
