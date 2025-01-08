<?php
include('db.php'); // Kết nối đến cơ sở dữ liệu

// Lấy ID người dùng từ tham số URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Kiểm tra xem usesr_id có tồn tại trong bảng
    $check_sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Nếu người dùng tồn tại, thực hiện xóa
        $delete_sql = "DELETE FROM users WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $user_id);

        if ($delete_stmt->execute()) {
            echo "<script>alert('Xóa người dùng thành công!'); window.location.href = 'manage_users.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi xóa người dùng!'); window.location.href = 'manage_users.php';</script>";
        }
    } else {
        echo "<script>alert('Người dùng không tồn tại!'); window.location.href = 'manage_users.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID người dùng không hợp lệ!'); window.location.href = 'manage_users.php';</script>";
}

$conn->close();
?>
