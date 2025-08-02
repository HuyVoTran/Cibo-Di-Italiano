<?php
// Kết nối tới cơ sở dữ liệu từ file data.php
include 'data.php';
session_start();

function fetchRecipes($conn, $category = null, $offset = 0, $limit = 5) {
    if ($category) {
        $query = "SELECT ID, MAIN_IMAGE, NAME FROM foods WHERE category = ? LIMIT ?, ?";
        $stmt = $conn->prepare($query);
        // Đảm bảo rằng offset và limit được chuyển đúng cách
        $stmt->bind_param("sii", $category, $offset, $limit);
    } else {
        $query = "SELECT ID, MAIN_IMAGE, NAME FROM foods ORDER BY UPLOAD DESC LIMIT ?, ?";
        $stmt = $conn->prepare($query);
        // Chuyển đổi offset và limit thành kiểu dữ liệu phù hợp
        $stmt->bind_param("ii", $offset, $limit);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result;
}

// Lấy các công thức theo loại
$antipastiRecipes = fetchRecipes($conn, 'antipasti', 0, 5);
$breadsRecipes = fetchRecipes($conn, 'bread', 0, 5);
$dessertsRecipes = fetchRecipes($conn, 'dessert', 0, 5);

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
    <link rel="stylesheet" href="styles/main-menu.css">
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
    
    <div class="lazy" id="recent-post">
        <div id="recipes" style="margin-top: 15vh;">
            <p class="title">Recent Posts</p>
            <p class="subtitle">The essence of Italian cooking today is simplicity. One uses the freshest seasonal ingredients possible and then uses basic cooking techniques to simply enhance the natural flavor of the food. Through this blog, I hope to share both my love of Italian cooking, as well as the customs involved in the preparation and sharing of a typical Italian meal. I plan on exploring the regional cuisine throughout Italy, and the seasonal specialties unique to each area. I hope to inspire everyone to try new recipes and to fully experience the joy of Italian cuisine.</p>
            <span class="line"></span>
        </div>
        <div class="recipes">
            <div class="recipe-grid">
                <?php while ($row = mysqli_fetch_assoc($recentPosts)): ?>
                    <div class="recipe-item">
                        <a href="post.php?ID=<?php echo $row['ID']; ?>">
                            <img src="<?php echo $row['MAIN_IMAGE']; ?>" alt="<?php echo htmlspecialchars($row['NAME']); ?>">
                            <p><?php echo htmlspecialchars($row['NAME']); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="overlay-button-black" style="text-align: center; margin-top: 3vh;">
                <a id="load-more-recent">VIEW MORE</a>
            </div>
            <script>
                document.getElementById('load-more-recent').addEventListener('click', function(event) {
                    event.preventDefault();
                    let offset = document.querySelectorAll('#recent-post .recipe-item').length;

                    fetch('load_more.php?recent=true&offset=' + offset)
                        .then(response => response.text())
                        .then(data => {
                            document.querySelector('.recipe-grid').insertAdjacentHTML('beforeend', data);
                        })
                        .catch(error => console.error('Error:', error));
                });
            </script>
        </div>
    </div>

    <div class="lazy" id="antipasti">
        <span class="line"></span>
        <div id="recipes">
            <p class="title">ANTIPASTI</p>
            <p class="subtitle">Antipasti, the traditional Italian starter, offers a delightful beginning to any meal. This vibrant assortment includes a variety of cured meats, cheeses, marinated vegetables, and olives, designed to awaken the palate and stimulate the appetite. Each region in Italy boasts its own unique selections, highlighting local ingredients and culinary traditions. Whether served on a rustic wooden board or elegantly plated, antipasti embodies the Italian spirit of sharing and enjoying food in a social setting.</p>
            <span class="line"></span>
        </div>
        <div class="recipes">
            <div class="recipe-grid">
                <?php while ($row = mysqli_fetch_assoc($antipastiRecipes)): ?>
                    <div class="recipe-item">
                        <a href="post.php?ID=<?php echo $row['ID']; ?>">
                            <img src="<?php echo $row['MAIN_IMAGE']; ?>" alt="<?php echo htmlspecialchars($row['NAME']); ?>">
                            <p><?php echo htmlspecialchars($row['NAME']); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="overlay-button-black" style="text-align: center; margin-top: 3vh;">
                <a id="load-more-antipasti">VIEW MORE</a>
            </div>
            <script>
                document.getElementById('load-more-antipasti').addEventListener('click', function(event) {
                    event.preventDefault();
                    let offset = document.querySelectorAll('#antipasti .recipe-item').length;

                    fetch('load_more.php?category=antipasti&offset=' + offset)
                        .then(response => response.text())
                        .then(data => {
                            document.querySelector('#antipasti .recipe-grid').insertAdjacentHTML('beforeend', data);
                        })
                        .catch(error => console.error('Error:', error));
                });
            </script>
        </div>
    </div>

    <div class="lazy" id="breads">
        <span class="line"></span>
        <div id="recipes">
            <p class="title">BREADS</p>
            <p class="subtitle">In Italian cuisine, bread holds a place of honor, serving as a staple at every meal. From the fragrant, golden crust of focaccia to the airy softness of ciabatta, Italian breads are crafted with care and tradition. These artisanal loaves are not only perfect for savoring on their own but also complement a variety of dishes, soaking up rich sauces and enhancing the overall dining experience. Each bite of freshly baked bread transports you to the heart of Italy, where time-honored recipes and baking techniques come to life.</p>
            <span class="line"></span>
        </div>
        <div class="recipes">
            <div class="recipe-grid">
                <?php while ($row = mysqli_fetch_assoc($breadsRecipes)): ?>
                    <div class="recipe-item">
                        <a href="post.php?ID=<?php echo $row['ID']; ?>">
                            <img src="<?php echo $row['MAIN_IMAGE']; ?>" alt="<?php echo htmlspecialchars($row['NAME']); ?>">
                            <p><?php echo htmlspecialchars($row['NAME']); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="overlay-button-black" style="text-align: center; margin-top: 3vh;">
                <a id="load-more-breads">VIEW MORE</a>
            </div>
            <script>
                document.getElementById('load-more-breads').addEventListener('click', function(event) {
                    event.preventDefault();
                    let offset = document.querySelectorAll('#breads .recipe-item').length;

                    fetch('load_more.php?category=bread&offset=' + offset)
                        .then(response => response.text())
                        .then(data => {
                            document.querySelector('#breads .recipe-grid').insertAdjacentHTML('beforeend', data);
                        })
                        .catch(error => console.error('Error:', error));
                });
            </script>
            </div>
    </div>

    <div class="lazy" id="desserts">
        <span class="line"></span>
        <div id="recipes">
            <p class="title">DESSERTS</p>
            <p class="subtitle">No Italian meal is complete without a touch of sweetness, and Italian desserts are a celebration of indulgence and artistry. Classics such as tiramisu, a luscious blend of coffee-soaked ladyfingers and mascarpone cheese, and cannoli, crispy pastry shells filled with sweet ricotta, are just the beginning. Each dessert tells a story of regional flavors and traditions, often featuring seasonal fruits and nuts. Italian desserts not only satisfy your sweet tooth but also provide a delightful finale to your culinary journey through Italy.</p>
            <span class="line"></span>
        </div>
        <div class="recipes">
            <div class="recipe-grid">
                <?php while ($row = mysqli_fetch_assoc($dessertsRecipes)): ?>
                    <div class="recipe-item">
                        <a href="post.php?ID=<?php echo $row['ID']; ?>">
                            <img src="<?php echo $row['MAIN_IMAGE']; ?>" alt="<?php echo htmlspecialchars($row['NAME']); ?>">
                            <p><?php echo htmlspecialchars($row['NAME']); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="overlay-button-black" style="text-align: center; margin-top: 3vh;">
                <a id="load-more-dessert">VIEW MORE</a>
            </div>
            <script>
                document.getElementById('load-more-dessert').addEventListener('click', function(event) {
                    event.preventDefault();
                    let offset = document.querySelectorAll('#desserts .recipe-item').length;
                    
                    fetch('load_more.php?category=dessert&offset=' + offset)
                        .then(response => response.text())
                        .then(data => {
                            document.querySelector('#desserts .recipe-grid').insertAdjacentHTML('beforeend', data);
                        })
                        .catch(error => console.error('Error:', error));
                });
            </script>
        </div>
    </div>

    <div id="coming-soon">
        <span class="line"></span>
        <div id="recipes">
            <p class="title">COMING SOON!</p>
            <p class="subtitle">We sincerely apologize for the delay in updating our information. We understand that this may cause inconvenience, and we are working diligently to resolve this issue as quickly as possible.</p>
            <p class="subtitle">Thank you for your patience and understanding. We truly appreciate your support.</p>
            <span class="line"></span>
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
<?php
// Đóng kết nối
mysqli_close($conn);
?>