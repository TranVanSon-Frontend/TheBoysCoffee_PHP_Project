<?php
$html_dssp_current_category = showsp($dssp);
?>
<div class="shop-all-1">
    <section class="shop-all">
        <div class="text">
            <a>Trang chủ</a>
            <a href="index.php?pg=shop" style="text-decoration: none; color:black">/ Tất cả sản phẩm</a>
        </div>

    </section>
    <div>
        <div class="container-shop">
            <div class="sidebar2">
                <h3>DANH MỤC SẢN PHẨM</h3>
                <ul>
                    <?php

                    foreach ($dsdm as $dm) {

                        echo '<li class=""><a href="index.php?pg=shop&iddm=' . $dm['id'] . '">' . htmlspecialchars($dm['ten_loai']);
                    }
                    ?>
                    <li><a href="#">Xem thêm &#9660;</a></li>
                </ul>

                <h3>MÀU SẮC</h3>
                <ul>
                    <li><input type="checkbox"> Trắng</li>
                    <li><input type="checkbox"> Đen</li>
                    <li><input type="checkbox"> Xám</li>
                    <li><input type="checkbox"> Vàng</li>
                    <li><input type="checkbox"> Đỏ</li>
                    <li><a href="#">Xem thêm &#9660;</a></li>
                </ul>

                <h3>GIÁ</h3>
                <ul>
                    <li><input type="checkbox"> Giá dưới 1.000.000đ</li>
                    <li><input type="checkbox"> 1.000.000đ - 2.000.000đ</li>
                    <li><input type="checkbox"> 2.000.000đ - 3.000.000đ</li>
                </ul>
            </div>

            <div class="main-content">
                <h2> <a style="text-decoration: none;color:black; text-transform:uppercase;"><?=$tieudetrang; ?></a></h2>
                <div class="sort-options">
                    <span>Sắp xếp: </span>
                    <a href="index.php?pg=shop&order=name_asc">Tên A → Z</a>
                    <a href="index.php?pg=shop&order=name_desc">Tên Z → A</a>
                    <a href="index.php?pg=shop&order=price_asc">Giá tăng dần</a>
                    <a href="index.php?pg=shop&order=price_desc">Giá giảm dần</a>
                    <a href="#">Hàng mới</a>
                </div>
                <div class="products">
                    <?= $html_dssp_current_category; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function addToCart(form) {
    var formData = $(form).serialize(); // Lấy dữ liệu từ form

    $.ajax({
        url: 'index.php?pg=cart', // URL của trang xử lý giỏ hàng
        type: 'POST',
        data: formData + '&cart=1', // Thêm tham số `cart=1` để xác định form gửi từ giỏ hàng
        success: function(response) {
            // Xử lý phản hồi từ server (hiển thị thông báo hoặc cập nhật giao diện)
            alert('Sản phẩm đã được thêm vào giỏ hàng');
            window.location.reload();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Có lỗi xảy ra, vui lòng thử lại');
        }
    });
}
</script>