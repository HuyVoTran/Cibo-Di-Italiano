<?php
include('data.php');
session_start();

$category = isset($_GET['category']) ? $_GET['category'] : null; // Kiểm tra nếu có tham số category
$offset = (int)$_GET['offset']; // Lấy giá trị offset từ yêu cầu
$limit = 5; // Số lượng công thức cần tải thêm

if ($category) {
    // Tải thêm công thức theo category
    $query = "SELECT ID, MAIN_IMAGE, NAME FROM foods WHERE category = ? LIMIT ?, ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sii", $category, $offset, $limit);
} else {
    // Tải thêm công thức gần đây
    $query = "SELECT ID, MAIN_IMAGE, NAME FROM foods ORDER BY UPLOAD DESC LIMIT ?, ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $offset, $limit);
}

$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra nếu có kết quả
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="recipe-item">
                    <a href="post.php?ID=' . $row['ID'] . '">
                        <img src="' . $row['MAIN_IMAGE'] . '" alt="' . htmlspecialchars($row['NAME']) . '">
                        <p>' . htmlspecialchars($row['NAME']) . '</p>
                    </a>
                  </div>';
        }
    } else {
        //echo '<div class="no-more-recipes">NO_MORE_RECIPES</div>';
    }
} else {
    echo "Lỗi truy vấn: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

