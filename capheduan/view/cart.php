<?php
if (is_user_logged_in()) {
    $html_cart_user = displayCart($ds_cart_user);
} else {
    $html_cart_user = displayCart(0);
}

$html_dssp_best = showsp($dssp_best);
?>
<div>
    <div class="container-cart">
        <div class="cart-container">
            <div class="cart-items">
                <h2>Giỏ hàng</h2>
                <section id="cart" class="section-p1">
                    <?php if (!empty($ds_cart_user)) : ?>
                        <table width="100%">
                            <tbody>
                                <?= $html_cart_user ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <div>
                            <div class="cart-emty">
                                <img src="img/cart_empty_background.webp" alt="Empty Cart Icon">
                                <h2>Không có gì trong giỏ hết</h2>
                                <p>Mua sắm để chất đầy giỏ hàng!!</p>
                                <a href="index.php?pg=shop">Mua sắm ngay</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>

                <?php if (!empty($ds_cart_user) && is_user_logged_in()) : // Kiểm tra giỏ hàng trống và người dùng đã đăng nhập 
                ?>
                    <?php
                    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
                    if ($id_user !== null) :
                        foreach ($ds_cart_user as $item) :
                            $sum_cart = get_sum_cart($id_user);
                        endforeach;
                        $sum_cart = get_sum_cart($id_user);
                        if ($sum_cart !== false) :
                    ?>
                            
            </div>
            <div class="cart-summary">
                
                <h2>Hẹn giờ nhận hàng</h2>
                <label for="delivery-date">Ngày nhận hàng</label>
                <input type="date" id="delivery-date" value="2024-07-28">
                <label for="delivery-time">Thời gian nhận hàng</label>
                <select id="delivery-time">
                    <option value="">Chọn thời gian</option>
                    <option value="morning">Buổi sáng</option>
                    <option value="afternoon">Buổi chiều</option>
                    <option value="evening">Buổi tối</option>
                </select>
                <div class="total-price"><?= number_format($sum_cart['tong_cart']) . ' VNĐ'; ?></div>
                <a href="index.php?pg=checkout" class="checkout-button" >Thanh Toán</a>
                <div class="payment-methods">
                    <img src="img-footer/pay.webp" alt="Visa">
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; // Đóng điều kiện kiểm tra giỏ hàng trống và người dùng đã đăng nhập 
?>
        </div>
    </div>
</div>
<div>
    <div class="products" style="width:1400px;margin:0px auto;">
        <h2>Có thể bạn cũng thích</h2>
        <div style="display:flex"><?= $html_dssp_best ?></div>
    </div>
</div>

<script>
    function decreaseQuantity(button) {
        var input = button.nextElementSibling;
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    function increaseQuantity(button) {
        var input = button.previousElementSibling;
        input.value = parseInt(input.value) + 1;
    }
    
function validateMinValue(input) {
    if (input.value <= 0) {
        input.value = 1;
    }
}

// function validateQuantity(form) {
//     var quantity = form.querySelector('input[name="quantity"]').value;
//     if (quantity <= 0) {
//         alert('Số lượng không thể nhỏ hơn hoặc bằng 0');
//         return false;
//     }
//     return true;
// }

</script>
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