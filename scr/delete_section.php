<?php 
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root"; // Thay bằng username của bạn
$password = "";     // Thay bằng password của bạn
$dbname = "studyfinder";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID của học phần cần xóa từ URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Chuyển đổi giá trị sang kiểu số nguyên để an toàn

    // Xóa học phần từ cơ sở dữ liệu
    $sql = "DELETE FROM sections WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Học phần đã được xóa thành công.";
        // Quay lại trang search.php
        header("Location: search.php");
        exit(); // Dừng thực thi sau khi chuyển hướng
    } else {
        echo "Lỗi khi xóa học phần: " . $conn->error;
    }
} else {
    echo "Không tìm thấy ID học phần để xóa.";
}

// Đóng kết nối
$conn->close();
?>
