<?php
// Kết nối tới cơ sở dữ liệu từ file data.php
include 'data.php';
session_start();

function fetchRecipes($conn, $category = null, $offset = 0, $limit = 5) {
    $query = "SELECT ID, MAIN_IMAGE, NAME FROM foods ORDER BY UPLOAD DESC LIMIT ?, ?";
    $stmt = $conn->prepare($query);
    // Chuyển đổi offset và limit thành kiểu dữ liệu phù hợp
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result;
}

// Lấy các bài viết gần đây với offset = 0 và limit = 5
$recentPosts = fetchRecipes($conn, null, 0, 5);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cibo di Italiano - Official Websites</title>
    <link rel="stylesheet" href="styles/permanent.css">
    <link rel="stylesheet" href="styles/styles.css">
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
    
    <div class="background">
        <div class="image-container">
            <img src="images/bg-1.png">
            <div class="overlay" id="overlay-1"></div>
            <div class="overlay-text" id="overlay-text-1">
                <p id="overlay-text-title">ITALIAN FOOD</p>
                <p id="overlay-text-content">Discover authentic Italian flavors in your own kitchen</p>
                <br>
                <div class="overlay-button-black"><a href="main-menu.php">BROWSE RECIPES</a></div>
            </div>
        </div>
    </div>

    <div class="lazy">
        <p id="overlay-text-title" style="text-align: center; background-color: #333333; padding: 3vh; margin: 0;">Recent Posts</p>
        <div class="home">
            <div class="recipe-grid" id="home">
                <?php while ($row = mysqli_fetch_assoc($recentPosts)): ?>
                    <div class="recipe-item">
                        <a href="post.php?ID=<?php echo $row['ID']; ?>">
                            <img src="<?php echo $row['MAIN_IMAGE']; ?>" alt="<?php echo htmlspecialchars($row['NAME']); ?>">
                            <p><?php echo htmlspecialchars($row['NAME']); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="overlay-button-black" style="text-align: center; margin-top: 3vh;"><a href="main-menu.php#recent-post">VIEW MORE</a></div>
        </div>
    </div>

    <div class="background">
        <div class="image-container">
            <img src="images/bg-2.png">
            <div class="overlay" id="overlay-2"></div>
            <div class="overlay-text" id="overlay-text-2">
                <p id="overlay-text-title">ABOUT ME</p>
                <p id="overlay-text-content">As a Vietnamese person with a deep love for Italian cuisine, I am captivated by the elegance and simplicity of each dish. Italian food is not just about pizza or pasta—it’s about the perfect harmony of fresh ingredients and skillful preparation. From the crispy bruschetta starters to the rich flavors of pasta drenched in tomato sauce and cheese, every meal feels like an emotional culinary experience. The connection between Italian culture and its cuisine makes me feel close to it and eager to explore more about the art of Italian cooking.</p>
                <br>
                <div class="overlay-button-white"><a href="contact.php">GET IN TOUCH</a></div>
            </div>
        </div>
    </div>

    <div class="background">
        <div class="image-container">
            <img src="images/bg-3.png">
            <div class="overlay" id="overlay-3"></div>
            <div class="overlay-text" id="overlay-text-3">
                <p id="overlay-text-content" style="font-style: italic; font-size: 1.5rem">"In Italy, they believe that food is not just meant to nourish the body but also the soul. Meals are celebrations of life, and every dish tells a story of love, tradition, and family. The Italians have long understood that the joy of eating is one of the finest pleasures in life."</p>
                <p id="overlay-text-content" style="font-style: italic; text-align: right;">- "Eat, Pray, Love", Elizabeth Gilbert</p>
                <br>
            </div>
        </div>
    </div>

    <div class="home-carroulser">
        <p id="overlay-text-title" style="text-align: center; background-color: #333333; padding: 3vh; margin: 0;">Popular Categories</p>
        <div class="carousel-container">
            <div class="carousel">
              <a class="slide" href="main-menu.php#antipasti">
                <img src="images/carousel/ca-1.jpg" alt="Antipasti" />
                <span class="overlay-text" id="overlay-text-carousel">Antipasti</span>
              </a>
              <a class="slide" href="main-menu.php#breads">
                <img src="images/carousel/ca-2.jpg" alt="Breads" />
                <span class="overlay-text" id="overlay-text-carousel">Breads</span>
              </a>
              <a class="slide" href="main-menu.php#desserts">
                <img src="images/carousel/ca-3.jpg" alt="Desserts" />
                <span class="overlay-text" id="overlay-text-carousel">Desserts</span>
              </a>
              <a class="slide" href="main-menu.php#dried-pasta">
                <img src="images/carousel/ca-4.jpg" alt="Dried Pasta" />
                <span class="overlay-text" id="overlay-text-carousel">Dried Pasta</span>
              </a>
              <a class="slide" href="main-menu.php#poultry">
                <img src="images/carousel/ca-5.jpg" alt="Poultry" />
                <span class="overlay-text" id="overlay-text-carousel">Poultry</span>
              </a>
              <a class="slide" href="main-menu.php#meats">
                <img src="images/carousel/ca-6.jpg" alt="Meats" />
                <span class="overlay-text" id="overlay-text-carousel">Meats</span>
              </a>
              <a class="slide" href="main-menu.php#salads">
                <img src="images/carousel/ca-7.jpg" alt="Salads" />
                <span class="overlay-text" id="overlay-text-carousel">Salads</span>
              </a>
              <a class="slide" href="main-menu.php#soups">
                <img src="images/carousel/ca-8.jpg" alt="Soups" />
                <span class="overlay-text" id="overlay-text-carousel">Soups</span>
              </a>
              <a class="slide" href="main-menu.php#vegetables">
                <img src="images/carousel/ca-9.jpg" alt="Vegetables" />
                <span class="overlay-text" id="overlay-text-carousel">Vegetables</span>
              </a>
            </div>
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
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
