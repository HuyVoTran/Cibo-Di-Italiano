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
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $name, $hashed_password);
            $stmt->fetch();
    
            if (password_verify($password, $hashed_password)) {
                $message = "Đăng nhập thành công!";
                $_SESSION['username'] = $username;
                $_SESSION['name'] = $name; 
                $_SESSION['user_id'] = $id;
                header("Location: index.php");
                exit();
            } else {
                $message = "Tên người dùng hoặc mật khẩu không đúng.";
            }
        } else {
            $message = "Tên người dùng hoặc mật khẩu không đúng.";
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
    <div class="sign-in">
        <div class="logo">
            <a href="index.php"><img src="images/logo-3.png" style="width: 10vw;"></a>
        </div>
        <p class="title">Sign In</p>
        <p class="required">*Required</p>
        <form method="POST">
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
                <button type="submit" class="button-black">Sign In</button>
                <button type="button" class="button-black" onclick="window.location.href='sign-up.php'">Sign Up</button>
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
