<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        if ($_SESSION['role'] === 'admin') {
            // Chuyển hướng admin về trang quản trị
            header("Location: admin.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Trường Đại học Trà Vinh</title>
    <link rel="stylesheet" href="./css/trangchu.css">
</head>
<body>

    <header class="header">
        <div>
            <img src="./image/logo.jpg" alt="Logo Đại học Trà Vinh">
        </div>
        <nav>
            <a href="index.php">Trang chủ</a>
            <a href="logout.php">Đăng xuất</a>
        </nav>
    </header>

    <main class="main-container">
       
        <section class="left-panel">
            <div class="announcement">
                <img src="image/anh1.png" alt="Thông báo">
            </div>
            <!-- <h2>Thông báo</h2>
            <div class="announcement-list">
                <ul>
                    <li><a href="#">Thông báo nghỉ Tết Nguyên đán 2025</a></li>
                    <li><a href="#">Kết quả đăng ký học kỳ 2 năm học 2024-2025</a></li>
                    <li><a href="#">Thông báo lễ bế giảng tốt nghiệp</a></li>
                    <li><a href="#">Tập huấn chiến lược học tập</a></li>
                </ul>
            </div> -->
        </section>

        
        <aside class="right-panel">
        <div class="">
        <?php
        if (isset($_SESSION['name'])) {
            echo "Xin chào, " . htmlspecialchars($_SESSION['name']);
        }
        ?>
    </div>    
        <div class="features">
        <h2 id="toggleButton">Tính năng</h2>
        <ul id="featureList">
        <li><a href="home.php">Tra cứu học phần</a></li><br>
    </ul>
</div>
        </aside>
    </main>
    <footer class="footer">
    <div class="footer-content">
        <p><strong>CỔNG THÔNG TIN SINH VIÊN</strong></p>
        <p>Đ/c: Tp. Trà Vinh, tỉnh Trà Vinh.</p>
        <p>Điện thoại: (0294) 0919899616</p>
        <p>Email: <a href="dotv2302@gmail.com">dotv2302@gmail.com</a> (mọi thắc mắc, vui lòng liên hệ qua email này).</p>
    </div>
</footer>
</body>
<script>
    document.getElementById("toggleButton").addEventListener("click", function () {
        const featureList = document.getElementById("featureList");
        if (featureList.style.display === "none" || featureList.style.display === "") {
            featureList.style.display = "block"; // Hiển thị danh sách
        } else {
            featureList.style.display = "none"; // Ẩn danh sách
        }
    });
</script>
</html>