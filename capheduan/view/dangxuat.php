<?php
// dao/user.php
session_start();

// Xóa toàn bộ session
session_unset();
session_destroy();

// Chuyển hướng về trang chủ hoặc trang đăng nhập nếu muốn
header("Location: index.php");
exit();
?>
