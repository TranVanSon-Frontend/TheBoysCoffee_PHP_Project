<?php
if (is_user_logged_in()) {
    $get_bill_user =  get_bill_user($_SESSION['id_user']);
}
if (isset($_GET['id_bill'])) {
    $id_bill = $_GET['id_bill'];
    $get_billchitiet_user =  get_billchitiet_user($_SESSION['id_user'], $id_bill);
    $show_billchitiet_user = show_billchitiet_user($get_billchitiet_user);
} else {
    $show_bill_user = show_bill_user($get_bill_user);
}
$existingPassword = "old_password";
?>
<div>
    <div class="container-user-pro">

        <div class="content-1">
            <div class="left-1">
                <div class="header-user-1" style="color:#212b25; font-size:19px;">TRANG TÀI KHOẢN</div>
                <strong style="display:flex;">
                    <p class="highlight" style="color:black;">Xin chào, </p><span style="color:#8b7046;"><?= $user_profile['hoten'] ?>!</span>
                </strong>
                <a href="index.php?pg=profile-user&act=profile-user">
                    <div class="menu-item">Thông tin tài khoản</div>
                </a>
                <a href="index.php?pg=profile-user&act=order">
                    <div class="menu-item">Đơn hàng của bạn</div>
                </a>
                <a href="index.php?pg=profile-user&act=user_updates"><div class="menu-item">Đổi mật khẩu</div></a>
                <a href="index.php?pg=dangxuat"><div class="menu-item">Thoát</div></a>
            </div>
            <?php
            if ($_GET['pg'] == 'profile-user' && !isset($_GET['act'])) {
                $_GET['act'] = 'profile-user';
            }
            switch ($_GET['act']) {
                case 'profile-user':
                    echo '<div class="right-1">
                <p style="font-size:19px; color:#212b25; padding-bottom: 10px;">THÔNG TIN TÀI KHOẢN</p>
                <p><strong>Họ tên:</strong> ' . $user_profile['hoten'] . '</p>
                <p><strong>Email:</strong> ' . $user_profile['email'] . '</p>
                <p><strong>Sđt:</strong> ' . $user_profile['dienthoai'] . '</p>
                <p><strong>Tên đăng nhập:</strong> ' . $user_profile['username'] . ' </p>
                <p><strong>Địa chỉ:</strong> ' . $user_profile['diachi'] . ' </p>
            </div>';
                    break;
                case 'order':
                    echo '
            <div class="right-1">
            <h1 style="font-size:19px;color:#212b25;">ĐƠN HÀNG CỦA BẠN</h1>
            <table>
                       <thead style="border-top:1px solid #ddd;border-bottom:1px solid #ddd; ">
                                   <tr>
                                      <td>Mã đơn hàng</td>
                                      <td>Tổng</td>
                                      <td>ngày</td>
                                      <td>Trang thái</td>
                                      <td>chi tiết</td>
                                      <td>Hủy đơn<td>
                                    </tr>
                        </thead>
            <tbody>
            
                ' . $show_bill_user . '
           
             </tbody>
              </table>
               </div>';
                    break;
                case 'order-chitiet':
                    echo '
                <div class="right-1">
                <h1 style="font-size:19px;color:#212b25;">ĐƠN HÀNG CỦA BẠN</h1>
                    <table style="font-size:14px;">
                     <thead style="border-top:1px solid #ddd;border-bottom:1px solid #ddd;font-size:13px; ">
                                    <tr>
                                      <td>Sản Phẩm</td>
                                      <td>Hình Ảnh</td>
                                      <td>Giá</td>
                                      <td>SL</td>
                                      <td >Tổng</td>
                                    </tr>
                    </thead>
                    <tbody>
                
                    '.$show_billchitiet_user.' 
               
            </tbody>
          </table>
        </div>';
                    break;
            
            case 'user_updates':
            echo '
            <script>
    function validatePassword() {
        var oldPassword = document.getElementById("oldpass").value;
        var existingPassword = "' . $existingPassword . '";

        if (oldPassword !== existingPassword) {
            alert("Mật khẩu cũ không đúng. Vui lòng thử lại.");
            return false;
        }
        return true;
    }
</script>      
              <div class="right-1">
              <h1 style="font-size:19px;color:#212b25;">ĐỔI MẬT KHẨU</h1>
             <div class="pws-note">Để đảm bảo tính bảo mật vui lòng đặt mật khẩu với ít nhất 8 kí tự</div>
              <form action="index.php?pg=profile-user" method="POST" onsubmit="return validatePassword()">
             <div>
            <label for="oldpass">Mật khẩu cũ <span class="pws-required">*</span></label>
            <input id="oldpass" name="oldpass" placeholder="Mật khẩu cũ" type="password">
             </div>
             <div>
            <label for="newpass">Mật khẩu mới <span class="pws-required">*</span></label>
            <input id="newpass" name="newpass" placeholder="Mật khẩu mới" type="password">
            </div>
             <div>
            <label for="confirmpass">Xác nhận lại mật khẩu <span class="pws-required">*</span></label>
            <input id="confirmpass" name="confirmpass" placeholder="Xác nhận lại mật khẩu" type="password">
            </div>
           <button name="submit" type="submit" class="pws-button" style="width:160px; height:40px;">Đặt lại mật khẩu</button>
    </form>
                                   </div> ';
            break;
            }
            ?>
        </div>
    </div>
</div>

