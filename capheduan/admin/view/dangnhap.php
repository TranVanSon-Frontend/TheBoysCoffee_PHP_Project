<section>
    <div id="login">
        <i class="far fa-times-circle close-login"></i>
        <h3 class="login-title">Đăng nhập hệ thống</h3>
        <p>Bạn chưa có tài khoản? <a href="index.php?pg=dangky">Đăng ký</a></p>
        <form action="" method="POST" id="form-login">
            <!-- Các trường nhập liệu cho đăng nhập -->
            <div class="form-group-login">
                <input type="text" name="username" id="username" class="email-ip" placeholder=" " required />
                <label for="username">Tên đăng nhập</label>
            </div>
            <div class="form-group-login">
                <input type="password" name="password" id="password" placeholder=" " required />
                <i class="far fa-eye eye"></i>
                <i class="far fa-eye-slash eye eye-none"></i>
                <label for="password">Mật khẩu</label>
            </div>
            <div class="btn-login pt-1">
                <button type="submit">Đăng nhập</button>
            </div>
        </form>
    </div>
</section>




