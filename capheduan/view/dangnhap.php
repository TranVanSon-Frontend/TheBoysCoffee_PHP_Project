<div>
    <div class="container-user" style="width: 400px;">
        <h1>Đăng nhập tài khoản</h1>
        <p>Bạn đã có tài khoản? Đăng ký <a href="index.php?pg=dangki">tại đây</a>.</p>
        <?php if ($is_user_logged_in): ?>
            <p>Bạn Đã Năng Nhập!</p>
        <?php else: ?>
        <form action="index.php?pg=dangnhap" method="POST">
            <label for="username">Tên đăng nhập </label>
            <input type="text" id="email" name="username" placeholder="Tên đăng nhập" required>

            <label for="password">Mật khẩu </label>
            <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
            
            <button type="submit" class="register-button">Đăng nhập</button>
        </form>
        <?php endif; ?>
        <?php
                        if($checkMK==1){
                            echo $saimatkhau;
                        }
                        if($checkMK==2){
                            echo $saitaikhoan;
                        }
                    ?>
       
        
    </div>
</div>