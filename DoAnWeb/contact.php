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

<body>
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
      
    <div class="post">
        <div class="lazy">
            <p class="mini-title">CONTACT</p>
            <p class="title">Contact Information</p>
            <p class="subtitle">By HituilaHuy - 11/10/2024</p>

            <div style="height: 5vh;"></div>

            <p class="content">If you have any questions, feedback, or just want to connect to discuss projects or shared interests, feel free to reach out using the contact information below. I’m always open to hearing from you and engaging in meaningful conversations!</p>

            <p class="topic">1. Information</p>
            <li class="content">Name: Tran Vo Huy (Salvio)</li>
            <li class="content">Email: Huyvo0911@gmail.com / Huy.2374802010192@vanlanguni.vn</li>
            <li class="content">Phone Number: (+84)76-766-7832</li>

            <p class="topic">2. Social Media:</p>
            <div class="social-icons" style="display: flex;justify-content: center;">
                <a href="https://www.facebook.com/huyyt0911" target="_blank" class="social-icon">
                    <img src="images/icons/facebook.png" alt="Facebook" style="max-width:50px;height:auto;margin:0;">
                </a>
                <a href="https://www.instagram.com" target="_blank" class="social-icon">
                    <img src="images/icons/instagram.png" alt="Instagram" style="max-width:50px;height:auto;margin:0;">
                </a>
                <a href="https://www.twitter.com" target="_blank" class="social-icon">
                    <img src="images/icons/twitter.png" alt="Twitter" style="max-width:50px;height:auto;margin:0;">
                </a>
            </div>

            <p class="content" style="font-weight: bold;margin-top:5vh;">Contact Me</p>
            <p class="content">If you'd like to get in touch, feel free to reach me via email or connect with me on social media!</p>

            <div style="height: 5vh;"></div>
        </div>
    </div>

    <div class="subscribe">
        <p style="font-size: 2rem;letter-spacing: 1.2px;margin-top: 7vh;font-weight:500px;">NEWSLETTER</p>
        <p style="font-size: 0.8rem;letter-spacing: 0.75px;margin-top: 2vh;font-style:italic;">Sign up for our weekly recipes, tips, and Italian cooking secrets!</p>
        <p style="font-size: 0.7rem;text-align:right;margin-right:35vw;margin-top: 3vh;color:darkgray">*Required</p>
        <form id="newsletterForm" action="subscribe.php" method="POST">
            <input type="email" id="email" name="email" placeholder=" Enter your email...*" required>
            <p id="message"></p>
            <button type="submit" class="subscribe-button">SUBSCRIBE</button>
        </form>
        <script>
            document.getElementById('newsletterForm').onsubmit = function(event) {
                event.preventDefault();

                var formData = new FormData(this);

                fetch('subscribe.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('message').innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
            };
        </script>
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
