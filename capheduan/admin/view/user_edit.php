<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = $_GET['id'];
    $user_info = get_user_by_id($user_id);
    if (!$user_info) {
        echo "Người dùng không tồn tại.";
        exit;
    }
} else {
    echo "ID người dùng không hợp lệ.";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Lấy thông tin từ form
    $new_role = isset($_POST['new_role']) ? $_POST['new_role'] : $user_info['role'];
    update_user_role($user_id, $new_role);
    header("location: index.php?pg=user");
}
?>

<div class="main-content">
    <h3 class="title-page">Thông tin tài khoản</h3>

    <form class="" action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="hoten">Họ và Tên</label>
            <input type="text" class="form-control" name="hoten" id="hoten" value="<?= htmlspecialchars($user_info['hoten']) ?>" readonly>
        </div>
        <div class="form-group">
            <label for="dienthoai">Số Điện Thoại</label>
            <input type="text" class="form-control" name="dienthoai" id="dienthoai" value="<?= $user_info['dienthoai'] ?>" readonly>
        </div>
        <div class="form-group">
            <label for="diachi">Địa Chỉ</label>
            <input type="text" class="form-control" name="diachi" id="diachi" value="<?= htmlspecialchars($user_info['diachi']) ?>" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" value="<?= htmlspecialchars($user_info['email']) ?>" readonly>
        </div>
        <div class="form-group">
            <label for="new_role">Vai Trò</label>
            <select class="form-control" name="new_role" id="new_role">
                <option value="0" <?php echo ($user_info['role'] == 0) ? 'selected' : ''; ?>>User</option>
                <option value="1" <?php echo ($user_info['role'] == 1) ? 'selected' : ''; ?>>Admin</option>
                <option value="2" <?php echo ($user_info['role'] == 2) ? 'selected' : ''; ?>>Block</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Cập nhật"></input>
        </div>
    </form>
</div>
