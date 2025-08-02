<?php
// Kết nối tới cơ sở dữ liệu từ file data.php
include 'data.php';
session_start();

$content = '';
$message = "";

// Lấy ID từ URL
if (isset($_GET['ID'])) {
    $id = intval($_GET['ID']);

    $sql = "SELECT * FROM foods WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        header('Location: not-found.php');
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Kiểm tra và hiển thị kết quả
    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            $content .= "<p class=\"mini-title\">RECIPES</p>";
            $content .= "<p class=\"title\">" . htmlspecialchars($row['NAME']) . "</p>";
            $content .= "<p class=\"subtitle\">By " . htmlspecialchars($row['AUTHOR']) . " - " . htmlspecialchars($row['UPLOAD']) . " - " . htmlspecialchars($row['CATEGORY']) . "</p>";
            $content .= "<img src=\"" . htmlspecialchars($row['MAIN_IMAGE']) . "\">";
            $content .= "<div style=\"height: 5vh;\"></div>";

            $descriptions = explode('|', $row['DESCRIPTION']);
            foreach ($descriptions as $description) {
                $content .= '<p class="content">' . htmlspecialchars(trim($description)) . '</p>';
            }

            $content .= "<div style=\"height: 5vh;\"></div>";

            $content .= "<div class=\"ingredients\">";

            $content .= "<div class=\"header\">";
            $content .= "<div class=\"left\">";
            $content .= "<p class=\"mini-title\">RECIPES</p>";
            $content .= "<p class=\"title\">" . htmlspecialchars($row['NAME']) . "</p>";
            $content .= "<p class=\"subtitle\">By " . htmlspecialchars($row['AUTHOR']) . " - " . htmlspecialchars($row['UPLOAD']) . " - " . htmlspecialchars($row['CATEGORY']) . "</p>";
            $content .= "</div>";
            $content .= "<div class=\"right\">";
            $content .= "<div class=\"overlay-button-black\"><a href=\"#\">PRINT</a></div>";
            $content .= "</div>";
            $content .= "</div>";

            $content .= "<p class=\"title\">INGREDIENTS</p>";
            $content .= "<ul>";
            $ingredients = explode('|', $row['INGREDIENTS']); 
            foreach ($ingredients as $ingredient) {
                $content .= '<li class="content">' . htmlspecialchars(trim($ingredient)) . '</li>';
            }
            $content .= "</ul>";
            $content .= "</div>";
        } else {
            header('Location: not-found.php');
            exit();
        }
    } else {
        header('Location: not-found.php');
        exit();
    }

    mysqli_stmt_close($stmt);
} else {
    header('Location: not-found.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = "";

    if (isset($_POST['action_type'])) {
        $action_type = $_POST['action_type'];

        // Xử lý đăng bình luận
        if ($action_type == "publish_comment") {
            if (!isset($_SESSION['user_id'])) {
                $message = "Vui lòng đăng nhập để bình luận.";
            } else {
                if (empty($_POST['comment'])) {
                    $message = "Bình luận không được để trống.";
                } else {
                    $user_id = $_SESSION['user_id'];
                    $post_id = intval($_GET['ID']);
                    $comment = trim($_POST['comment']);
                    $created_time = date("Y-m-d H:i:s");

                    $stmt = $conn->prepare("INSERT INTO COMMENTS (USER_ID, POST_ID, COMMENT, CREATED_TIME) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiss", $user_id, $post_id, $comment, $created_time);

                    if ($stmt->execute()) {
                        $message = "Bình luận đã được đăng thành công!";
                    } else {
                        $message = "Lỗi: " . $conn->error;
                    }

                    $stmt->close();
                }
            }
        }

        // Xử lý xóa bình luận
        elseif (isset($_POST['delete_comment_id']) && isset($_SESSION['user_id'])) {
            $comment_id = intval($_POST['delete_comment_id']);
            $user_id = $_SESSION['user_id'];
        
            $sql = "DELETE FROM COMMENTS WHERE ID = ? AND USER_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $comment_id, $user_id);
            $stmt->execute();
        
            if ($stmt->affected_rows > 0) {
                $message = "Bình luận đã được xóa thành công.";
            } else {
                $message = "Có lỗi xảy ra khi xóa bình luận.";
            }
        
            $stmt->close();
        }

        // Xử lý sửa bình luận
        elseif (isset($_POST['edit_comment_id'], $_POST['edit_comment_content']) && isset($_SESSION['user_id'])) {
            $comment_id = intval($_POST['edit_comment_id']);
            $new_content = htmlspecialchars($_POST['edit_comment_content']);
            $user_id = $_SESSION['user_id'];
        
            $sql = "UPDATE COMMENTS SET COMMENT = ? WHERE ID = ? AND USER_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $new_content, $comment_id, $user_id);
            $stmt->execute();
        
            if ($stmt->affected_rows > 0) {
                $message = "Bình luận đã được sửa thành công.";
            } else {
                $message = "Có lỗi xảy ra khi sửa bình luận.";
            }
        }
    }
}
// mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cibo di Italiano - Official Websites</title>
    <link rel="stylesheet" href="styles/permanent.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/post.css">
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
        <?php echo $content;?>

        <div class="comments" id="comments">
                <p class="title">Comments</p>
                <form class="comment-form" method="POST">
                    <div class="comment-top">
                        <?php if (isset($_SESSION['name'])): ?>
                            <p class="comment-name"><?php echo htmlspecialchars($_SESSION['name']); ?></p>
                        <?php else: ?>
                            <p class="comment-name">Đăng nhập để bình luận</p>
                        <?php endif; ?>
                        <button class="comment-button" style="float: right;" type="submit" name="submit" formaction="#comments">PUBLISH</button>
                    </div>
                    <input type="hidden" name="action_type" value="publish_comment">
                    <textarea class="comment-input" name="comment" placeholder="Bạn nghĩ gì về bài viết này?..."></textarea>
                    <p class="messages"><?php echo $message; ?></p>
                </form>
                <?php
                    $post_id = intval($_GET['ID']);

                    // Truy vấn tất cả các bình luận cho post_id
                    $sql = "SELECT C.ID, C.COMMENT, C.CREATED_TIME, U.NAME, U.ID AS USER_ID FROM COMMENTS C JOIN USERS U ON C.USER_ID = U.ID WHERE C.POST_ID = ? ORDER BY C.CREATED_TIME DESC";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $post_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    // Kiểm tra và xuất các bình luận
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="comment">';
                        echo '    <div class="comment-top">';
                        echo '        <div>';
                        echo '            <p class="comment-name">' . htmlspecialchars($row['NAME']) . '</p>';
                        echo '            <p class="comment-date">' . date("d/m/Y", strtotime($row['CREATED_TIME'])) . '</p>';
                        echo '        </div>';
                        echo '        <div>';
                        
                        // Kiểm tra xem USER_ID của bình luận có trùng với người dùng hiện tại không
                        if (isset($_SESSION['user_id'])) {
                            $currentUserId = $_SESSION['user_id'];
                            if ($row['USER_ID'] == $currentUserId) {
                                echo '            <div class="burger-menu">';
                                echo '                <span></span>';
                                echo '                <span></span>';
                                echo '                <span></span>';
                                echo '            </div>';
                                echo '            <div class="dropdown-menu">';
                                echo '                <a onclick="editComment(' . $row['ID'] . ', \'' . htmlspecialchars($row['COMMENT']) . '\')">Sửa</a>';
                                echo '                <a onclick="deleteComment(' . $row['ID'] . ')">Xóa</a>';
                                echo '            </div>';
                            }
                        }
                        echo '        </div>';
                        echo '    </div>';
                        echo '    <p class="comment-post">' . htmlspecialchars($row['COMMENT']) . '</p>';
                        echo '</div>';
                    }
                    ?>

                    <script>
                        document.querySelectorAll('.burger-menu').forEach(menu => {
                            menu.addEventListener('click', function() {
                                const dropdown = this.nextElementSibling;
                                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                            });
                        });
                        
                        document.addEventListener('click', function(e) {
                            if (!e.target.closest('.comment')) {
                                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                                    menu.style.display = 'none';
                                });
                            }
                        });
                        function deleteComment(commentId) {
                            if (confirm("Bạn có chắc chắn muốn xóa bình luận này không?")) {
                                // Tạo form và gửi yêu cầu xóa
                                const form = document.createElement('form');
                                form.method = 'POST';
                                form.style.display = 'none';
                                
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'delete_comment_id';
                                input.value = commentId;
                                form.appendChild(input);

                                const actionTypeInput = document.createElement('input');
                                actionTypeInput.type = 'hidden';
                                actionTypeInput.name = 'action_type';
                                actionTypeInput.value = 'delete_comment';
                                form.appendChild(actionTypeInput);
                                
                                document.body.appendChild(form);
                                form.submit();
                            }
                            if (!location.href.includes("#comments")) {
                                location.href = location.href.split("#")[0] + "#comments";
                            }
                        }

                        function editComment(commentId, commentContent) {
                            const newContent = prompt("Chỉnh sửa bình luận của bạn:", commentContent);
                            if (newContent) {
                                // Tạo form và gửi yêu cầu sửa
                                const form = document.createElement('form');
                                form.method = 'POST';
                                form.style.display = 'none';

                                const idInput = document.createElement('input');
                                idInput.type = 'hidden';
                                idInput.name = 'edit_comment_id';
                                idInput.value = commentId;
                                form.appendChild(idInput);

                                const actionTypeInput = document.createElement('input');
                                actionTypeInput.type = 'hidden';
                                actionTypeInput.name = 'action_type';
                                actionTypeInput.value = 'edit_comment';
                                form.appendChild(actionTypeInput);

                                const contentInput = document.createElement('input');
                                contentInput.type = 'hidden';
                                contentInput.name = 'edit_comment_content';
                                contentInput.value = newContent;
                                form.appendChild(contentInput);

                                document.body.appendChild(form);
                                form.submit();
                            }
                            if (!location.href.includes("#comments")) {
                                location.href = location.href.split("#")[0] + "#comments";
                            }
                        }
                    </script>
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