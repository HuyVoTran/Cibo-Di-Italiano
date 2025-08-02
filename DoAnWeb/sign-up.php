<?php
// Kết nối tới cơ sở dữ liệu từ file data.php
include 'data.php';
session_start();
// Khởi tạo biến thông báo
$message = "";

// Kiểm tra nếu kết nối không thành công
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows == 0) {
            $stmt->close(); // Đóng truy vấn trước khi thực hiện thêm
            $stmt = $conn->prepare("INSERT INTO users (name, username, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $username, $password);
    
            if ($stmt->execute()) {
                $message = "Bạn đã đăng ký thành công!";
                header("Location: sign-in.php");
                exit();
            } else {
                $message = "Lỗi: " . $stmt->error;
            }
        } else {
            $message = "Tên người dùng đã tồn tại.";
        }
    
        $stmt->close();
    } else {
        $message = "Cần phải điền đầy đủ.";
    }
    
}

// Đóng kết nối
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cibo di Italiano - Official Websites</title>
    <link rel="stylesheet" href="styles/permanent.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/account.css">
    <link rel="icon" href="images/favicon_io/favicon.ico" type="image/x-icon">
    <!-- Liên kết file JavaScript -->
    <script src="java.js"></script>
</head>

<!---Import Font--->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Noto+Serif+Display:ital,wdth,wght@0,62.5..100,100..900;1,62.5..100,100..900&display=swap');
</style>

<!-- Color Palettes
    Tan: #B68D40
    Cream: #F4EBD0
    Light Black: #333333
    Gold: #D6AD60-->

<body>
    <div class="sign-up">
        <div class="logo">
            <a href="index.php"><img src="images/logo-3.png" style="width: 10vw;"></a>
        </div>
        <p class="title">Sign Up</p>
        <p class="required">*Required</p>
        <form method="POST">
            <div class="input-form">
                <p class="content">Your name:</p>
                <input type="text" id="name" name="name" placeholder="" required>
            </div>
            <div class="input-form">
                <p class="content">Username:</p>
                <input type="text" id="username" name="username" placeholder="" required>
            </div>
            <div class="input-form">
                <p class="content">Password:</p>
                <input type="password" id="password" name="password" placeholder="" required>
            </div>
            <p class="messages"><?php echo $message; ?></p>
            <div class="button">
                <button type="submit" class="button-black">Sign Up</button>
                <button type="button" class="button-black" onclick="window.location.href='sign-in.php'">Sign In</button>
            </div>
        </form>
    </div>

    <footer style="background-color: #F4EBD0;">
        <div class="down-footer">
            <a href="index.php">Home</a>
            <a href="main-menu.php">Browse Recipes</a>
            <a href="tips.php">Kitchen Tips</a>
            <a href="contact.php">Contact</a>
        </div>
    </footer>

</body>
</html>
