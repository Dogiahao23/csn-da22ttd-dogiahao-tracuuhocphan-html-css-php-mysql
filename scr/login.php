<?php
session_start(); // Bắt đầu session
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Kiểm tra mật khẩu
        if (password_verify($password, $user['password'])) {
            // Lưu thông tin đăng nhập vào session
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name']; // Lưu tên của người dùng
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_id'] = $user['user_id']; // Lưu `user_id` vào session

            // Chuyển hướng tới trang admin nếu là admin
            if ($user['role'] === 'admin') {
                header("Location: admin.php");
                exit;
            } else {
                // Chuyển hướng tới trang chủ nếu là user
                header("Location: index.php");
                exit;
            }
        } else {
            echo "Mật khẩu không đúng!";
        }
    } else {
        echo "Tên đăng nhập không tồn tại!";
    }

    $stmt->close();
}
?>
