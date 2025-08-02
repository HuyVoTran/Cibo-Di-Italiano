<?php
// Kết nối tới cơ sở dữ liệu từ file data.php
include 'data.php';

session_start();
session_destroy();
header("Location: index.php");
exit();
?>