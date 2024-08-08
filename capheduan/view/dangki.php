<div>
    <div class="container-user">
        <h1>Đăng Ký Tài Khoản</h1>
        <p>Bạn đã có tài khoản? Đăng nhập <a href="index.php?pg=dangnhap">tại đây</a>.</p>
        <form action="index.php?pg=dangki" method="POST">
            <label for="hoten">Họ tên*</label>
            <input type="text" id="last-name" name="hoten" placeholder="Họ" required>

            <label for="email">Email *</label>
            <input type="email" id="first-name" name="email" placeholder="email" required>

            <label for="dienthoai">Số điện thoại *</label>
            <input type="tel" id="phone" name="dienthoai" placeholder="Số điện thoại" required>

            <label for="username">Tên đăng nhập *</label>
            <input type="text" id="email" name="username" placeholder="Tên đăng nhập" required>

            <label for="password">Mật khẩu *</label>
            <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
            
            <button type="submit" class="register-button">Đăng ký</button>
        </form>

       
    </div>
</div>