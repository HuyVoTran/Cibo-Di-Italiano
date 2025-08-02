<?php
// Kết nối tới cơ sở dữ liệu từ file data.php
include 'data.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cibo di Italiano - Official Websites</title>
    <link rel="stylesheet" href="styles/permanent.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/more.css">
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

<body style="background-color: #F4EBD0;">
    <header>
        <div class="logo">
            <a href="index.php"><img src="images/logo-3.png"></a>
        </div>
        <nav class="nav-menu">
            <a href="index.php">Home</a>
            <a href="main-menu.php">Browse Recipes</a>
            <a href="tips.php">Kitchen Tips</a>
            <a href="contact.php">Contact</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="sign-out.php">Sign Out</a>
            <?php else: ?>
                <a href="sign-in.php">Sign In</a>
            <?php endif; ?>
        </nav>
    </header>
      
    <div class="notfound-post">
        <div class="lazy">
            <p class="notfound-title">ERROR 404!</p>
            <p class="notfound-mini-title">Oops! That page can't be found.</p>
            <div class="overlay-button-black" style="font-weight: normal;"><a href="index.php">BACK TO HOME</a></div>
        </div>
    </div>

    <footer>
        <div class="up-footer">
            <div class="logo">
                <a href="index.php"><img src="images/logo-3.png"></a>
            </div>
            <p>Đồ Án Môn Lập trình ứng dụng Web - 241_71ITSE30503_03</p>
            <p>Email: contact@hituilahuy.com</p>
            <p>&copy; 2024 Tran Vo Huy.</p>
            <h2>Social Media</h2>
            <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank" class="social-icon">
                    <img src="images/icons/facebook.png" alt="Facebook">
                </a>
                <a href="https://www.instagram.com" target="_blank" class="social-icon">
                    <img src="images/icons/instagram.png" alt="Instagram">
                </a>
                <a href="https://www.twitter.com" target="_blank" class="social-icon">
                    <img src="images/icons/twitter.png" alt="Twitter">
                </a>
            </div>
        </div>
        <div class="down-footer">
            <a href="index.php">Home</a>
            <a href="main-menu.php">Browse Recipes</a>
            <a href="tips.php">Kitchen Tips</a>
            <a href="contact.php">Contact</a>
        </div>
    </footer>

</body>
</html>
