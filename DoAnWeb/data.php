<?php
// Thông tin kết nối MySQL
$serverName = "localhost"; // Địa chỉ server (thường là localhost)
$username = "root";        // Tài khoản MySQL (mặc định là root)
$password = "";            // Mật khẩu (thường để trống cho root trên máy local)
$database = "recipes";        // Tên cơ sở dữ liệu

// Kết nối tới MySQL
$conn = mysqli_connect($serverName, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
} else {
    // echo "Kết nối thành công!";
}
?>
