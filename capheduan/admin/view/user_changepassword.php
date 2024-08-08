<?php
include_once "../dao/user.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $new_password = $_POST["new_password"];

    if (update_password($user_id, $new_password)) {
        header("Location: user.php");
        exit();
    }
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $user = get_user_by_id($user_id);
} else {
    header("Location: user.php");
    exit();
}

?>

<div class="container">
    <h2>Đổi Mật Khẩu</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
        <div class="form-group">
            <label for="new_password">Mật Khẩu Mới:</label>
            <input type="password" class="form-control" id="new_password" name="new_password">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
